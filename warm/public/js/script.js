  document.addEventListener('DOMContentLoaded', function() {
    var options = document.querySelectorAll('option');
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  document.addEventListener('DOMContentLoaded', function() {
    var options = document.querySelectorAll('option');
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems, options);
  });

  document.addEventListener('DOMContentLoaded', function() {
    var options = document.querySelectorAll('option');
    var elems = document.querySelectorAll('.timepicker');
    var instances = M.Timepicker.init(elems, options);
  });
    
