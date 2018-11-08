<style type="text/css">
    #watermark_pos_select {
		width:150px;
		height:150px;
        font-size: 12px;
		text-align:center;
    }
    #watermark_pos_select td {
        cursor: pointer;
    }
    .pos_hover {
        background-color: yellow;
    }
    .pos_select {
        background-color: yellow;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('#watermark_pos_select td').each(function(){
            if($(this).html()==<?php echo get('watermark_pos') ?>)
            $(this).addClass('pos_select');
        });
        $('#watermark_pos_select td').hover(function(){
            $(this).addClass('pos_hover');
        }, function(){
            $(this).removeClass('pos_hover');
        })
        $('#watermark_pos_select td').click(function(){
            $('#watermark_pos_select td').each(function(){
                $(this).removeClass('pos_select');
            });
            $('#watermark_pos').val($(this).html());
            $(this).addClass('pos_select');
        });
        $('#watermark_pos').click(function(){
            $('#watermark_pos_select td').each(function(){
                $(this).removeClass('pos_select');
            });
            $('#watermark_pos_select td').each(function(){
                if($(this).html()== $('#watermark_pos').val())
                    $(this).addClass('pos_select');
            });
        });
    });
</script>

<div style="display: inline-table">
    <table border="1" width="1"  id="watermark_pos_select" cellpadding="3" cellspacing="3">
        <tbody>
            <tr>
                <td align="center" valign="top">1</td>
                <td align="center" valign="top">2</td>
                <td align="center" valign="top">3</td>
            </tr>
            <tr>
                <td align="center">4</td>
                <td align="center">5</td>
                <td align="center">6</td>
            </tr>
            <tr>
                <td align="center" valign="bottom">7</td>
                <td align="center" valign="bottom">8</td>
                <td align="center" valign="bottom">9</td>
            </tr>
        </tbody>
    </table>
</div>