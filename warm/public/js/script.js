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

  
  const pList = document.querySelector("#p_list");

  pList.addEventListener("click", function(){
    const pTable = document.querySelector("#p_table");
    
      if(pTable.style.display =="none"){
        pTable.style.display = "block";
      }else{
        pTable.style.display = "none";
      }
  })

  const qList = document.querySelector("#q_list");

  qList.addEventListener("click", function(){
    const qTable = document.querySelector("#q_table");

      if(qTable.style.display =="none"){
        qTable.style.display = "block";
      }else{
        qTable.style.display = "none";
      }
  })
    
