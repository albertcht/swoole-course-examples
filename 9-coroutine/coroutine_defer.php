<?php

go(function () {
   echo "a\n";
   defer(function () {
       echo "~a\n";
   });

   echo "b\n";
   defer(function () {
       echo "~b\n";
   });

   echo "c\n";
});
