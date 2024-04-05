<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
	public function dashboard()
	{
		if (auth()->check()) {
			$tableName = 'listings';
			$columnNames = Schema::getColumnListing($tableName);	
			$categoriesCount = Category::count();
			$tagsCount = Tag::count();
			$listings = Listing::all();
			
			$dropdownData = GeneralHelper::getDropdowns();
			$listingsCount = $listings->count();
			
			return view('dashboard', compact('categoriesCount', 'tagsCount', 'listingsCount', 'dropdownData', 'columnNames'));
		} else {
			return redirect()->route('index');
		}
	}

	public function changePassword(Request $request)
	{
		if ($request->new_password == $request->confirm_password) {
			$user = User::where('id', auth()->user()->id)->first();
			if ($user) {
				if (password_verify($request->current_password, $user->password)) {
					$user->password = bcrypt($request->new_password);
					if ($user->update()) {
						Auth::guard('web')->logout();
						$request->session()->invalidate();
						$request->session()->regenerateToken();
						return redirect()->route('login')->with('message', 'Password updated successfully. Login with new password');
					} else {
						return redirect()->route('profile')->with("error", "An error occurred. Please try again.");
					}
				} else {
					return redirect()->route('profile')->with("error", "Old password dosen't match our records. Please try again.");
				}
			} else {
				return redirect()->route('profile')->with("error", "An error occurred. Please try again.");
			}
		} else {
			return redirect()->route('profile')->with("error", "New Password and Confirm Password should be same. Please try again.");
		}
	}
}
