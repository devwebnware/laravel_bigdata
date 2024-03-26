<?php

namespace App\Console\Commands;

use App\Events\ActivityLog;
use App\Models\Task;
use App\Models\TaskEmployee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RecurringTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Recurring Tasks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tasks = Task::whereDate('recurring_date', Carbon::now())->get();
        foreach ($tasks as $task) {
            $newTask = new Task();
            $newTask->project_id = $task->project_id;
            $newTask->milestone_id = $task->milestone_id;
            $newTask->created_by = $task->created_by;
            $newTask->priority = $task->priority;
            $newTask->name = $task->name;
            $newTask->description = $task->description;
            $newTask->deadline = $task->deadline;
            $newTask->estimated_hours = 0;
            $newTask->type = $task->type;
            $newTask->status = config('variable.task_default_status_id');

            if ($task->recurring_date) {
                if ($task->recurring_time_type == 'day') {
                    $recurringDate = Carbon::now()->addDays($task->recurring_time_value);
                } else if ($task->recurring_time_type == 'week') {
                    $recurringDate = Carbon::now()->addWeeks($task->recurring_time_value);
                } else {
                    $recurringDate = Carbon::now()->addMonths($task->recurring_time_value);
                }
                $newTask->recurring_time_type = $task->recurring_time_type;
                $newTask->recurring_time_value = $task->recurring_time_value;
                $newTask->recurring_date = $recurringDate;
            }
            if ($newTask->save()) {
                $totalEstimatedTime = 0;
                $taskEmployees = TaskEmployee::where('task_id', $task->id)->get();
                foreach ($taskEmployees as $item) {
                    $newTaskEmployee = new TaskEmployee();
                    $newTaskEmployee->task_id = $newTask->id;
                    $newTaskEmployee->user_id = $item->user_id;
                    $newTaskEmployee->details = $item->details;
                    $newTaskEmployee->estimated_hours =  $item->estimated_hours;
                    if ($newTask->recurring_time_type == 'day') {
                        $newTaskEmployee->deadline = Carbon::parse($item->deadline)->addDays($newTask->recurring_time_value);
                    } else if ($newTask->recurring_time_type == 'week') {
                        $newTaskEmployee->deadline = Carbon::parse($item->deadline)->addWeeks($newTask->recurring_time_value);
                    } else {
                        $newTaskEmployee->deadline = Carbon::parse($item->deadline)->addMonths($newTask->recurring_time_value);
                    }
                    $newTaskEmployee->save();
                    $totalEstimatedTime += $item->estimated_hours;
                    $activity = [
                        'message' => 'Task: ' . $newTask->name . ' has been assigned to you by ' . $newTask->createdBy->name . '.',
                        'type'  => 'create',
                        'sender_id'  => $newTask->created_by,
                        'receiver_id'  => $newTaskEmployee->user_id
                    ];
                    ActivityLog::dispatch($activity);
                }
                if ($newTaskEmployee->save()) {
                    $newTask->estimated_hours = $totalEstimatedTime;
                    $newTask->update();
                }
            }
        }
    }
}
