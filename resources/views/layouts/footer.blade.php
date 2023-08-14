<footer id="footer" class="footer-area pt-170">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="footer-widget">
                    <a href="{{ route('home') }}" class="logo d-blok">
                        <img src="assets/images/logo.svg" alt="">
                    </a>
                    <p>{{ __('footer.company_short_desc') }}</p>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 offset-xl-1 offset-lg-1 col-md-6">
                <div class="footer-widget">
                    <h5>{{ __('footer.quick_links') }}</h5>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('navbar.home') }}</a></li>
                        <li><a href="{{ route('courses') }}">{{ __('navbar.courses') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6">
                <div class="footer-widget">
                    <h5>{{ __('footer.categories') }}</h5>
                    <ul>
                        @php($categories = \App\Models\Category::all())
                        @foreach($categories as $category)
                            <li><a href="{{ route('courseCategory', ['category_id' => $category->id]) }}">{{ $category->category }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h5>{{ __('footer.contact_us') }}</h5>
                    <ul>
                        <li><p>{{ __('general.phone') }}: +884-9273-3867</p></li>
                        <li><p>{{ __('forms.email') }}: hello@gmail.com</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-credit">
            <div class="row">
                <div class="col-md-6">
                    <div class="copy-right text-center text-md-left">
                        <p>{{ __('footer.copy') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-social">
                        <ul class="d-flex justify-content-md-end justify-content-center">
                            <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-twitter-filled"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-instagram-filled"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js">
@vite('resources/js/main.js')
