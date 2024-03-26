<footer>
    <div class="container-fluid p-0">
        <div class="rightSection justify-content-center d-md-flex p-3 align-items-center flex-fill">
            <div class="row w-100">
                <div class="col-6">
                    <p>
                        संकेतस्थळावरील माहितीचा सर्वाधिकार कल्याण डोंबिवली महानगरपालिका,कल्याण
                    </p>
                </div>
                <div class="col-6 text-end">
                    <p>
                        Designed & Handcrafted with <i class="fas fa-heart text-danger"></i>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Button trigger modal -->
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.modern-ticker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(function() {
        $(".ticker1").modernTicker({
            effect: "scroll",
            scrollType: "continuous",
            scrollStart: "inside",
            scrollInterval: 20,
            transitionTime: 500,
            autoplay: true
        })
    })
</script>

<script type="text/javascript">
    $(".owl-carousel1").owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        nav: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            1000: {
                items: 6,
            },
        },
    });
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
