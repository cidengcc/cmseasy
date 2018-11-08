<?php if (!defined('ROOT')) exit('Can\'t Access !');?>
<?php //WWW ?>

    <style type="text/css">
        .a_view,.a_del { border: none;}
        .a_view {margin-right:15px;}
        .file_check_search span {color: red; font-weight: bold;padding:0px 5px;}
        .wait {
            background:url({$base_url}/images/admin/loading.gif) left center no-repeat;
            height: 52px;
			line-height:52px;
            padding-left: 52px;
            clear:both;
            display: none;
        }

        .btn btn-primary {
            float: left;
            margin-right: 15px;
        }

        .checkform ul {
            clear:both;
        }

        .checkform li {
            clear:both;
        }

        .checkform input[type='checkbox'] {
            margin-right: 5px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            var submit=false;
            $('.checkform').find(':submit').click(function (e) {
                if(submit==true)
                    return false;
                $(this).next('.wait').css('display','block');
                submit=true;
            });
        });
    </script>

<?php include ROOT.'/lib/plugins/filecheck/action.php' ?>
