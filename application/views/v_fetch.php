<html>
<?php $this->load->view("/frag/head.php")?>
<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Dashboard</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
 
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">

            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="<?php echo site_url("fetch")?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                All Hero Data
                            </a>
                            <a class="nav-link" href="<?php echo site_url("fetch/meta1")?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Meta Suggestion (Win/Pick Rate)
                            </a>
                            </div>

                    </div>
                    <div class="sb-sidenav-footer">

                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">API Data Fetch</h1>
                        <br>
                        
                        <br>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                <div class="col-md-9">
                                    OpenDota Data Fetch
                                </div>
                                
                                
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
<?php

$template = array(
    'table_open'            => '<table id="dataDota" class="table">',

    'thead_open'            => '<thead class="thead-dark">',
    'thead_close'           => '</thead>',

    'heading_row_start'     => '<tr>',
    'heading_row_end'       => '</tr>',
    'heading_cell_start'    => '<th>',
    'heading_cell_end'      => '</th>',

    'tbody_open'            => '<tbody id="data-tampil">',
    'tbody_close'           => '</tbody>',

    'row_start'             => '<tr>',
    'row_end'               => '</tr>',
    'cell_start'            => '<td>',
    'cell_end'              => '</td>',

    'row_alt_start'         => '<tr>',
    'row_alt_end'           => '</tr>',
    'cell_alt_start'        => '<td>',
    'cell_alt_end'          => '</td>',

    'table_close'           => '</table>'
);

$this->table->set_template($template);
$this->table->set_heading('ID', 'Name', 'Action');

for($l=0;$l<count($json);$l++){
    $this->table->add_row(
        $json[$l]['hero_id'], //print id
        $json[$l]['localized_name'], //print name
        '<button type="button" class="btn btn-info" onclick="getID('.$json[$l]['hero_id'].')" data-target="#modalDetail" id='.$json[$l]['hero_id'].'>Info</button>');

 
}


echo $this->table->generate();
?>

</div>

</body>
<!-- Modal -->
<div id="modalDetail" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hero Detail</h4>
      </div>
      <div class="modal-body">
      <table id="classTable" class="table table-bordered">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>Hero ID :</td>
              <td id="hero_id"></td>
            </tr>
            <tr>
              <td>Hero Name :</td>
              <td id="hero_name"></td>
            </tr>
            <tr>
              <td>Hero Localized Name :</td>
              <td id="hero_local"></td>
            </tr>
            <tr>
              <td>Hero Image :</td>
              <td>
              <img id="picture" src="" alt="" class="img-thumbnail">
              </td>
            </tr>
            <tr>
                <td>Pro Stats :</td>
                <td>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Win</th>
                        <th>Pick</th>
                        <th>Ban</th>
                    </tr>
                    <tr>
                        <td id="pro_win">Win</td>
                        <td id="pro_pick">Pick</td>
                        <td id="pro_ban">Ban</td>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </td>
            </tr>
           
</tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

<script>
$(document).ready( function () {
    $('#dataDota').DataTable();
} );

function getID(clickedID){
      $.ajax({
                    url: '<?php echo base_url(); ?>/fetch/get_by_id',
                    method: 'post',
                    data: {id:clickedID},
                    success:function(data){
                        var json = JSON.parse(data);
                        $('#hero_id').html(json["id"]);
                        $('#hero_name').html(json["name"]);
                        $('#hero_local').html("<strong>"+json["localized_name"]+"</strong>");
                        $('#pro_win').html(json["pro_win"]);
                        $('#pro_pick').html(json["pro_pick"]);
                        $('#pro_ban').html(json["pro_ban"]);
                        $("#picture").attr("src","https://api.opendota.com"+json["img"]);
                        $("#modalDetail").modal('show');
                    }
                });
    }
</script>

</html>



