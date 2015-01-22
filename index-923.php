<html>

<?php

  // @matt: this is the path to the lib that can parse CSV as a php OBJ 
  // we need this file in a sub directiory from whereever this index.php lives
  require_once 'inc/parsecsv-for-php-master/parsecsv.lib.php';

  
  $csv = new parseCSV();
  // @matt: It looks for a file called "saucematrix.csv" which is a sibling to this index.php
  // you can update this files as needed. Keep in minf the column headers need to stay the same
  $csv->auto('saucematrix.csv');
  $wing_data = json_encode($csv->data);

?>


<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.js"></script>
<style>
body{
    font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
   font-weight: 300;
}
</style>
<script type="text/javascript">
  var data = <?php echo $wing_data; ?>;

  $(document).ready(function(){

      var wingTable = $('#favorite-flavors').DataTable({
        data: data,
        paging: false,
        columns: [
            { data: 'Place' },
            { data: function ( row ){
              return "<img src='" + row.Image +  "' />" 
            }},
            { data: 'Name' },
            { data: 'Desc' },
            { data: 'Qty' },
            { data: 'Category' }
        ]
      });
      new $.fn.dataTable.FixedHeader( wingTable );
  })
</script>

<table id="favorite-flavors">
    <thead>
        <tr>
            <th>Place</th>
            <th>Image</th>
            <th>Name</th>
            <th>Desc</th>
            <th>Qty</th>
            <th>Category</th>
        </tr>
    </thead>
</table>
</html>