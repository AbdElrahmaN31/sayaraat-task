<?php header("Content-type: text/css; charset: UTF-8");
$headerHeightPrint = $_GET['headerHeightPrint'];
$headerHeightScreen = $_GET['headerHeightScreen'];
$headerImageHeightScreen = $_GET['headerImageHeightScreen'];
$footerHeightPrint = $_GET['footerHeightPrint'];
$footerHeightScreen = $_GET['footerHeightScreen'];
$footerImageHeightScreen = $_GET['footerImageHeightScreen'];
?>

.prescription-report p{
    font-size: 32px;
}
.first-item {
  margin-top: 20px;
}

table {
page-break-inside: avoid;
}
tr {
    page-break-inside: avoid;
    <!-- page-break-after: always; -->
}
tbody:last-child > tr:last-child {
page-break-after: avoid;
}

 /* styles for screen */
@media screen {
    .show-in-print {
        visibility: hidden;
    }
  .header-height {
    height: <?php echo $headerHeightScreen + 20; ?>px;
    padding-bottom: 20px

  }
  .header-img {
    background: white;
    height: <?php echo $headerImageHeightScreen; ?>px;
  }
  .footer-height {
    height: <?php echo $footerHeightScreen; ?>px;

  }
  .footer-img {
    background: white;
    height: <?php echo $footerImageHeightScreen; ?>px;
  }
}

/* styles for print */
@media print {
    .show-in-print {
        visibility: visible;
    }
  .header-height {
    height: <?php echo $headerHeightPrint + 40; ?>px;
    padding-bottom: 40px
  }
  .header-img {
    background: white;
    height: <?php echo $headerHeightPrint; ?>px;
  }
  .footer-height {
    height: <?php echo $footerHeightPrint; ?>px;
  }
  .footer-img {
    background: white;
    height: <?php echo $footerHeightPrint; ?>px;
  }

  .hide-in-print {
    display: none;
  }
}