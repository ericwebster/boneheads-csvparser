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


<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
<?php
  //@matt you can remove jquery here if its defined elsewhere in your site but
  // included on this page
?>
<script type="text/javascript" charset="utf8" src="assets/js/jquery.js"></script>
<script type="text/javascript" charset="utf8" src="assets/js/jquery.dataTables.js"></script>
<style>
body{
    font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; 
   font-weight: 300;
}
</style>
<script type="text/javascript">
  // @matt: this is where we push the JSON object to javascrtipt
  var wingData = <?php echo $wing_data; ?>;

  $(document).ready(function(){
      // @matt: this is where we tell jquery to bind the plugin and data to the html 
      var wingTable = $('#favorite-flavors').DataTable({
        data: wingData,
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