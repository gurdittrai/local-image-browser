<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css?ver=0.1.4" />
    <link rel="stylesheet" type="text/css" href="Styles/bg-drops.css?ver=0.1.0" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>

<body>
    <div class="bg-anime">
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
        <div class="droplet"></div>
    </div>
    <div id="wrapper">
        <div class="nav-bar">
            <div class="switch">
                <?php echo $switch; ?>
            </div>
            <div class="btns">
                <div class="btn">
                    <button id="single">Single Slide</button>
                </div>
                <div class="btn">
                    <button id="double">Less Slides</button>
                </div>
                <div class="btn">
                    <button id="multi">Multiple Slides</button>
                </div>
            </div>

        </div>

        <div id="content_area">
            <?php echo $content; ?>
        </div>
        <footer>
            <div>END</div>
        </footer>
    </div>
    <!-- lightbox -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="script/imagepop.js"></script>
    <script type="text/javascript">
        // nav bar
        $(document).on("click", "#single", function() {
            $(".grid").css("display", "block");
        });
        $(document).on("click", "#double", function() {
            $(".grid").css("display", "grid");
            $(".grid").css("grid-template-columns", "repeat(4, 1fr)");
        });
        $(document).on("click", "#multi", function() {
            $(".grid").css("display", "grid");
            $(".grid").css("grid-template-columns", "repeat(6, 1fr)");
        });
    </script>
</body>

</html>