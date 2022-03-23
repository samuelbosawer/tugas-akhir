<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>rating</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/rating/css/star-rating.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/rating/css/bootstrap.css">

    <link href="<?= base_url() ?>assets/depan/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/aos/aos.css" rel="stylesheet">

</head>

<body>
    <div class="text-center">
        <p>
        <h4>Rate Data</h4>
        <input id="rating-input" type="text" title="" />
        </p>
    </div>

    <script type="text/javascript" src="<?= base_url() ?>assets/rating/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/rating/js/star-rating.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/rating/js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var $inp = $('#rating-input');


            $inp.rating({
                min: 0,
                max: 5,
                step: 1,
                size: 'sm',
                showClear: false
            });
            $inp.on('rating.change', function() {
                alert('Nilai rating : ' + $('#rating-input').val());
            });
        });
    </script>
</body>

</html>