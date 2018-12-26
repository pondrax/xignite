<html>
<head>
<title>Laporan BAB V</title>

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
margin: 3cm 2cm;
width:16cm;
 }
#header { 
position: fixed; 
left: 0px; 
top: -3cm; 
right: 0px; 
height: 1.8cm; 
padding-top:1cm;
text-align: right; 
border-bottom:1px solid #000;
}
#footer { 
padding:2px;
position: fixed; 
left: 0px; 
bottom: -3cm; 
right: 0px;
height: 2.5cm;
border-top:1px solid #000;
}
#footer .page{
  float:right;
  background:#ccc;
  padding:3px 15px;
}
#footer .page .number:after { content: counter(page, numeric); }
#footer .footer{
padding:5px 0;
float:left;  
}
</style>
</head>
<body>

  <div id="header">
    <h4 style="color:#999;font-weight:narrow">
      BAB V<br>
      PENYELENGGARAAN TUGAS PEMBANTUAN DAN DEKONSENTRASI
    </h4>
  </div>
  <div id="footer">
    <div class="footer">
      <b>
        LKPJ Gubernur Tahun Anggaran 
        <mark>{{$logged->tahun}}</mark>
      </b>
    </div>
    <div class="page">      
      @if(count($pengguna)==1)
        <mark>{{(array_values($pengguna)[0])}}</mark> |
      @endif
      BAB V - <span class="number"></span>
    </div>
    <div style="clear:both"></div>
  </div>
  <div class="report-page border p-5">
    <h1 class="text-center">
      BAB V
      <br>
      PENYELENGGARAAN TUGAS PEMBANTUAN DAN DEKONSENTRASI
    </h1>
    <br>
  <!-- Mulai loop instansi#deskripsi -->
  @define($_bab=-1)
  @define($_no=-1)
  @foreach($daftar_pengisi as $idi=>$pengisi)
    @if($_bab!=$pengisi->bab)
      @define($_no=0)
      @if($pengisi->bab=="Tugas Pembantuan")
      <h2>A. TUGAS PEMBANTUAN </h2>
      @elseif($pengisi->bab=="Dekonsentrasi")
      <h2 class="break-page">B. DEKONSENTRASI </h2>
      @endif
    @endif
    @define($_bab=$pengisi->bab)
    @define($_no+=1)
    <h3 class="@if($_no!=1) break-page @endif text-uppercase">
      <mark>{{$_no}}</mark>
      .&nbsp;
      <mark>{{$pengguna[$pengisi->id_user]}}</mark>
    </h3>
    <div class="indent">
      <div class="text-center">
        <b>
          Tabel Rincian Pagu dan realisasi keuangan pendanaan {{$_bab}} di
          <mark>{{$pengguna[$pengisi->id_user]}}</mark>
          Tahun
          <mark>{{$logged->tahun}}</mark>
        </b>
      </div>
      <!-- Mulai tabel pagu#program -->
      <table>
        <thead>
          <tr>
            <th>NO</th>
            <th>PROGRAM</th>
            <th>PAGU</th>
            <th>REALISASI</th>
            <th>%</th>
          </tr>
        </thead>
        <tbody>
          @define($_target=0)
          @define($_realisasi=0)
          @define($no_program=0)
          <!-- Mulai loop tabel pagu#program -->
          @foreach($daftar_program as $idp=>$program)
            @if($pengisi->id_user==$program->id_user)
              @define($no_program+=1)
              @define($_target+=(int)str_replace('.','',$program->target))
              @define($_realisasi+=(int)str_replace('.','',$program->realisasi))
              <tr>
                <td class="text-center"><mark>{{$no_program}}</mark></td>
                <td><mark>{{$program->program}}</mark></td>
                <td class="text-center">
                  <mark>{{parseRP($program->target)}}</mark>
                </td>
                <td class="text-center">
                  <mark>{{parseRP($program->realisasi)}}</mark>
                </td>
                <td class="text-center">
                  <mark>{{str_replace('.',',',$program->persentase)}}</mark>
                </td>
              </tr>
            @endif
          @endforeach
          <!-- Berhenti loop tabel pagu#program -->
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2" class="text-center"><b>JUMLAH</b></td>
            <td class="text-center">
              <b><mark>{{parseRP($_target)}}</mark></b>
            </td>
            <td class="text-center">
              <b><mark>{{parseRP($_realisasi)}}</mark></b>
            </td>
            <td class="text-center">
              @if($_realisasi>0)
              <b><mark>{{number_format($_realisasi/$_target*100,2,',','.')}}</mark></b>
              @else
              <b><mark>0,00</mark></b>
              @endif
            </td>
          </tr>
        </tfoot>
      </table>
      <!-- Berhenti tabel pagu#program -->
      
      <br>
      <!-- Mulai dasar hukum#dasar -->
      <h3>A. DASAR HUKUM</h3>
      @foreach($daftar_deskripsi as $idd=>$deskripsi)
        @if($pengisi->id_user==$deskripsi->id_user)
          <mark>{{$deskripsi->dasar_hukum}}</mark>
        @endif
      @endforeach
      <!-- Berhenti dasar hukum#dasar -->
      
      
      <br>
      <!-- Mulai program kegiatan#program -->
      <h3>B. PROGRAM KEGIATAN</h3>
      <ol>
        @foreach($daftar_program as $idp=>$program)
          @if($pengisi->id_user==$program->id_user)
            <li>
              <mark>{{$program->program}}</mark>
              <ol type="alpha">
                <!-- Mulai loop kegiatan#program -->
                @foreach($daftar_kegiatan as $idk=>$kegiatan)
                  @if($program->id==$kegiatan->id_program)
                    <li>
                      <mark>{{$kegiatan->kegiatan}}</mark>,
                      dengan alokasi anggaran sebesar 
                      <mark>Rp. {{$kegiatan->target}},-</mark>
                      terealisasi sebesar
                      <mark>Rp. {{$kegiatan->realisasi}},-</mark>
                      atau 
                      <mark>{{$kegiatan->persentase}}</mark>
                      dengan hasil kegiatan
                      <mark>{{$kegiatan->hasil_kegiatan}} </mark>.
                    </li>
                  @endif
                @endforeach
                <!-- Berhenti loop kegiatan#program -->
              </ol>
            </li>
          @endif
        @endforeach
      </ol>
      <!-- Berhenti program kegiatan#program -->
      
      
      <br>
      <!-- Mulai dasar hukum#dasar -->
      <h3>C. PERMASALAHAN DAN SOLUSI</h3>
      @foreach($daftar_deskripsi as $idd=>$deskripsi)
        @if($pengisi->id_user==$deskripsi->id_user)
        <div class="">
          <p><b>Permasalahan :</b></p>
          <p><mark>{{$deskripsi->permasalahan}}</mark></p>
          <p><b>Solusi :</b></p>
          <p><mark>{{$deskripsi->solusi}}</mark></p>
        </div>
        @endif
      @endforeach
      <!-- Berhenti dasar hukum#dasar -->
      
      
    
    
    
    
    
    </div>
  @endforeach
  <!-- Berhenti loop instansi#deskripsi -->
</div>
</body>
</html>