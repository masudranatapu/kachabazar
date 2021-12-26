<div class="slider_area slider_three owl-carousel mb-0">
    @foreach ($sliders as $key=>$slider)
        <div class="single_slider">
            <a href="#">
                <img style="width: 100%; height: 536px;" src="{{ url($slider->image) }}" alt="slider image">
            </a>
        </div>
    @endforeach
</div>
