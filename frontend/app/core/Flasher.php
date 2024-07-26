<?php

class Flasher
{
  public static function flash($popup)
  {
    if (Session::exists('flash')) {
      $message = Session::get('flash')['message'];
      $type = Session::get('flash')['type'];

      if ($popup) {
        $component = '#alertContainer';
        $classType = $type;
      } else {
        $component = '#alert';
        $classType = 'status-' . $type;
      }

      $el = '
      <script>
        function showAlert(message) {
          $("' . $component . '").text(message);
          $("' . $component . '").show("show");
          $("' . $component . '").addClass("' . $classType . '");

          $("' . $component . '").click(function() {
            showModal();
          });

          setTimeout(function() {
            $("' . $component . '").hide("slow");
          }, 5000);
        }

        showAlert("' . $message . '");
      </script>
      ';

      echo $el;
    }

    Session::delete('flash');
  }

  public static function set($message, $type = 'success')
  {
    Session::set([
      'flash' => [
        'message' => $message,
        'type' => $type
      ]
    ]);
  }
}
