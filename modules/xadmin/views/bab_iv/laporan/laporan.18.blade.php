<html>
<head>
<title>Laporan BAB IV</title>

<style>
.text-center{
  text-align:center;
}
.text-uppercase{
  text-transform:uppercase;
}
.report-page{
  font-family: Arial,"Times New Roman";
  text-align:justify;
  font-size:12pt;
  margin:20px auto;
  width:16cm;
}
.report-page *{  font-family: Arial,"Times New Roman";}
.report-page table{
  width:100%;
  margin:10px 0 15px ;
    border-collapse: collapse;
}
.report-page table thead{
  background:#ccc;
}
.report-page th{
  border:1px solid #000;
  padding:10px 15px;
  text-align:center;
  font-weight:bold;
}
.report-page td{
  padding:5px 15px;
  border:1px solid #000;
}
.report-page h1{
  font-size:20pt;
  font-weight:bold;
  height:30pt;
}
.report-page h2{
  font-size:16pt;
  font-weight:bold;
  display:block;
  text-transform:uppercase;
}
.report-page h3{
  font-size:15pt;
  font-weight:bold;
}
.report-page h3{
  font-size:12pt;
  font-weight:bold;
}
.report-page p{
  font-size:12pt;
}
.report-page .list {
  padding-left:25px;
}
.report-page .list:before {
    content: "\203A";
    position: absolute;
    margin-left: -15px;
}
.report-page .list2{
  padding-left:.5cm;
}
.report-page .list2:before {
    content: "\2022";
    position: absolute;
    margin-left: -15px;
}

.indent{
  padding-left:1cm;
}
.report-page .break-page{
  page-break-before: always;
}
.report-page ol,
.report-page ul{
  padding-top:5pt;
  padding-left:20pt;
}
.report-page ol li,
.report-page ul li{
  padding:0 0 10pt 0;
}

@page {
margin: 3cm 2cm 3cm 3cm;
width:16cm;
 }
#header { 
position: fixed; 
left: 0px; 
top: -3cm; 
right: 0px; 
height: 1.2cm; 
padding-top:1.5cm;
text-align: right; 
border-bottom:1px double #000;
}
#footer { 
position: fixed; 
left: 0px; 
bottom: -3cm; 
right: 0px;
height: 2.5cm; 
border-top:1px solid #000;
}
#footer .page{
  text-align:center;
}
#footer .page:after { content: counter(page, numeric); }
</style>
</head>
<body>

<div id="header">
  <h3>Laporan Keterangan Pertanggung Jawaban Gubernur Tahun 2018</h3>
</div>
<div id="footer">
  <p class="page">Halaman </p>
</div>
@if(isset($show_toolbar))
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#" class="reload-tab" data-title="Laporan Report BAB IV" data-url="@url/xadmin/bab_iv/laporan/view/" data-get="">Laporan Report BAB IV</a>
      </li>
      <li class="breadcrumb-item">
        <a href="@url/xadmin/bab_iv/laporan/view/laporan.pdf" target="_blank">PDF</a>
      </li>
    </ol>
  </nav>
@endif
<div class="report-page border p-5">
  <h1 class="text-center">BAB IV</h1>
  <h1 class="text-center">PENYELENGGARAAN URUSAN PEMERINTAHAN DAERAH</h1>
  <br>
  <br>
  <h2>A. URUSAN WAJIB YANG DILAKSANAKAN</h2>
  
  <!-- Urusan mulai loop -->
  @foreach($daftar_urusan as $idu=>$u)
    <h3 class="text-uppercase @if($idu) break-page @endif">
      1. BIDANG <mark>{{$u->urusan}}</mark>
    </h3>
    <h3 class="text-uppercase">1.1. <mark>{{$u->instansi}}</mark></h3>
    <h3>a. Tujuan</h3>
    <div class="indent">
      <mark>{{$u->tujuan}}</mark>
    </div>
    <br>
    <h3>b. Sasaran</h3>
    <div class="indent">
      <div class="text-center">
        <b>Tabel Realisasi Indikator Kinerja Sasaran Tahun <mark>{{$u->id_tahun}}</mark></b>
      </div>
      <table>
        <thead>
          <tr>
            <th>SASARAN</th>
            <th>INDIKATOR KINERJA</th>
            <th>TARGET</th>
            <th>REALISASI</th>
            <th>PERSENTASE</th>
          </tr>
        </thead>
        <tbody>
        @foreach($daftar_sasaran as $ids=>$s)
          @if($u->id_user==$s->id_user)
            @if(!empty($s->sasaran_indikator))
              @foreach($s->sasaran_indikator as $i)
              <tr>
                <td><mark>{{$s->sasaran}}</mark></td>
                <td><mark>{{$i->indikator}}</mark></td>
                <td class="text-center"><mark>{{$i->target}}</mark></td>
                <td class="text-center"><mark>{{$i->realisasi}}</mark></td>
                <td class="text-center"><mark>{{$i->persentase}}</mark></td>
              </tr>
              @endforeach
            @endif
          @endif
        @endforeach
        </tbody>
      </table>
      <p>
        Pada Tahun <mark>{{$u->id_tahun}}</mark> kinerja <mark>{{$u->instansi}}</mark> yang telah dicapai berdasarkan masing-masing sasaran adalah sebagai berikut:
      </p>
      @define($_ids='')
      @foreach($daftar_sasaran as $ids=>$s)
        @if($u->id_user==$s->id_user)
          @if($_ids!==$ids)
            <p>
              <b>Sasaran <mark>{{$ids+1}}</mark>:</b> <mark>{{$s->sasaran}}</mark> , ditetapkan <mark> @if(!empty($s->sasaran_indikator))
                {{count($s->sasaran_indikator)}}
              @else 0 @endif </mark>  indikator kinerja yaitu:
            </p>
          @endif
          @define($_ids=$ids)
          @if(property_exists($s,'sasaran_indikator'))
            @foreach($s->sasaran_indikator as $si)
              <p class="list">
                Indikator Sasaran <mark>{{$si->indikator}}</mark> pada tahun <mark>{{$u->id_tahun}}</mark> dengan target sebesar <mark>{{$si->target}}</mark> dan terealisasi sebesar <mark>{{$si->realisasi}}</mark> atau <mark>{{$si->persentase}}</mark> persen; 
              </p>
            @endforeach
          @endif
        @endif
      @endforeach
    </div>
    
    
    <!-- Program dan kegiatan Loop -->
    <br>
    <h3>c. Program dan Kegiatan</h3>
    @foreach($daftar_program as $idp=>$p)
      @if($u->id_user==$p->id_user)
      <div class="indent">
      <p>
        <mark><b>{{$p->program}}</b></mark> dengan anggaran sebesar <mark>Rp. {{$p->target}},-</mark> dan terealisasi sebesar <mark>Rp. {{$p->realisasi}},-</mark> atau <mark>{{$p->persentase}}</mark>. Dengan indikator kinerja yaitu : 
      </p>
      
      @foreach($p->program_indikator as $pi)
        <p class="list">
          Indikator Program <mark>{{$pi->indikator}}</mark> dengan target <mark>{{$pi->target}}</mark> dan <mark>{{$pi->realisasi}}</mark>. ({{$pi->persentase}})
        </p>
      @endforeach
      <br>
      <p>
        Program tersebut didukung oleh <mark>...</mark> kegiatan.
      </p>
      <ol>
      @foreach($daftar_kegiatan as $idk=>$k)
        @if($p->id==$k->id_program)
          <li> 
            <mark>{{$k->kegiatan}}</mark> dengan anggaran sebesar <mark>Rp. {{$k->target}},-</mark> dan terealisasi sebesar <mark>Rp. {{$k->realisasi}},-</mark> atau <mark>{{$k->persentase}}</mark>. Dengan indikator kinerja yaitu :
          <ul>
            @if(!empty($k->kegiatan_indikator))
              @foreach($k->kegiatan_indikator as $ki)                
              <li>
                <mark>{{$ki->indikator}}</mark> dengan target sebesar <mark>{{$ki->target}}</mark> dan realisasi sebesar <mark>{{$ki->realisasi}}</mark>. <mark>{{$i->persentase}}</mark>
              </li>
              @endforeach
            @endif
          </ul>
          </li>
        @endif
      @endforeach
      </ol>
      <br>
    </div>
    @endif
    @endforeach
    
    <br>
    <h3>d. Permasalahan dan Solusi</h3>
    <div class="indent">
      <p><b>Permasalahan :</b></p>
      <p><mark>{{$u->permasalahan}}</mark></p>
      <p><b>Solusi :</b></p>
      <p><mark>{{$u->solusi}}</mark></p>
    </div>
    
    <br>
    <h3>e. Penghargaan Nasional</h3>
    <div class="indent">
      <p><mark>{{$u->penghargaan}}</mark></p>
    </div>
    
    
  <!-- Urusan berhenti -->
  @endforeach
</div>
</body>
</html>