<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="<?= base_url("assets/style.css") ?>" rel="stylesheet"/>
    <?php
    function isMobileDevice(): bool
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $mobileKeywords = array('Mobile', 'Android', 'iPhone', 'iPad', 'Windows Phone', 'BlackBerry');
        foreach ($mobileKeywords as $keyword) {
            if (stripos($userAgent, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    if (isMobileDevice()) {
        echo '<link href=' . base_url("assets/responsive_style.css") . ' rel="stylesheet"/>';
    }
    ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Smooch+Sans">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/icon.ico') ?>">
    <title>PassSafe Pro: Easy, Simple, Independent!</title>
    <script>
        <?php
        include_once(dirname(__FILE__) . '/../scripts/crypto-js.min.js');
        include_once(dirname(__FILE__) . '/../scripts/script.js');
        ?>
    </script>
</head>
