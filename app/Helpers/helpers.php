<?php

/**
 * @param $message, provided  to alert the Error for Invalid Token
 ** @param $title, for error tittle
 */
function warningMessage($title,$message): string
{
    return '<script>
        swal.fire({
              title: \''.$title.'\',
              text: \''.$message.'\',
              type: \'warning\',
              timer: 9000,
              showCancelButton: false,
              confirmButtonColor: \'#d33\',
              confirmButtonText: \'OK !!\'
        })
    </script>';
}

