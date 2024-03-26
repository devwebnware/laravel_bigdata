<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{$id}}" aria-expanded="false" aria-controls="{{$id}}">
            {{$title}}
        </button>
    </h2>
    <div id="{{$id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">{{$description}}</div>
    </div>
</div>