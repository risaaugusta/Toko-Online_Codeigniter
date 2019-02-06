<h2>Daftar Data</h2>
<?= $this->session->flashdata('pesan'); ?>
<center>
  <a href="#tambah" data-toggle="modal" class="btn btn-warning" style="margin-left: -1050px; margin-bottom: 20px;">Tambah</a>
</center>
<table id="example" class="table table-hover table-striped">
  <thead>
    <tr>
      <td>No</td>
      <td>Foto Cover</td>
      <td>Merk Barang</td>
      <td>Size</td>
      <td>Kategori</td>
      <td>Harga</td>
      <td>Stok</td>
      <td>Aksi</td>
    </tr>
  </thead>
  <tbody>
    <?php $no=0; foreach($tampil_jannah as $jannah):
    $no++; ?>
    <tr>
      <td><?= $no ?></td>
      <td><img src="<?=base_url('assets/img/'.$jannah->foto )?>" style="width: 40px"></td>
      <td><?= $jannah->merk_jannah ?></td>
      <td><?= $jannah->size ?></td>
      <td><?= $jannah->nama_kategori ?></td>
      <td><?= $jannah->harga ?></td>
      <td><?= $jannah->stok ?></td>
      <td><a href="#edit" onclick="edit('<?= $jannah->id_jannah ?>')" data-toggle="modal" class="btn btn-success">Ubah</a>
        <a href="<?=base_url('index.php/jannah/hapus/'.$jannah->id_jannah)?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Hapus</a></td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>

<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-titile">Tambah Data</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/jannah/tambah')?>" method="post" enctype="multipart/form-data">
          <table>
            <tr>
              <td><input type="hidden" name="id_jannah" class="form-control"></td>
            </tr>
            <tr>
              <td>Merk Barang</td>
              <td><input type="text" name="merk_jannah" required class="form-control"></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td><select name="id_kategori" class="form-control">
                <option></option>
                <?php foreach($kategori as $kat): ?>
                <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
                <?php endforeach ?>
              </select></td>
            </tr>
            <tr>
              <td>Size</td>
              <td><input type="number" name="size" required class="form-control"></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td><input type="number" name="harga" required class="form-control"></td>
            </tr>
            <tr>
              <td>Stok</td>
              <td><input type="number" name="stok" required class="form-control"></td>
            </tr>
            <tr>
              <td>Foto </td>
              <td><input type="file" name="foto" class="form-control"></td>
            </tr>
          </table>
          <input type="submit" name="create" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-titile">Edit jannah</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/jannah/jannah_update')?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_jannah_lama" id="id_jannah_lama">
          <table>
            <tr>
              <td><input type="hidden" name="id_jannah" id="id_jannah" class="form-control"></td>
            </tr>
            <tr>
              <td>Merk Barang</td>
              <td><input type="text" name="merk_jannah" id="merk_jannah" required class="form-control"></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td><select name="id_kategori" class="form-control" id="id_kategori">
                <option></option>
                <?php foreach($kategori as $kat): ?>
                <option value="<?=$kat->id_kategori?>"><?=$kat->nama_kategori?></option>
                <?php endforeach ?>
              </select></td>
            </tr>
            <tr>
              <td>Size</td>
              <td><input type="number" name="size" required id="size" class="form-control"></td>
            </tr>
            <tr>
              <td>Harga</td>
              <td><input type="number" name="harga" required id="harga" class="form-control"></td>
            </tr>
            <tr>
              <td>Stok</td>
              <td><input type="number" name="stok" required id="stok" class="form-control"></td>
            </tr>
            <tr>
              <td>Foto Cover</td>
              <td><input type="file" name="foto" id="foto_" class="form-control"></td>
            </tr>
          </table>
          <input type="submit" name="edit" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function edit(a){
    $.ajax({
      type:"post",
      url:"<?=base_url()?>index.php/jannah/edit_jannah/"+a,
      dataType:"json",
      success:function(data){
        $("#id_jannah").val(data.id_jannah);
        $("#merk_jannah").val(data.merk_jannah);
        $("#size").val(data.size);
        $("#id_kategori").val(data.id_kategori);
        $("#harga").val(data.harga);
        $("#stok").val(data.stok);
        $("#id_jannah_lama").val(data.id_jannah);
      }
    })
  }
</script>