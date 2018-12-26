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
      BAB IV<br>
      PENYELENGGARAAN URUSAN PEMERINTAHAN DAERAH
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
      BAB IV - <span class="number"></span>
    </div>
    <div style="clear:both"></div>
  </div>
  <div class="report-page border p-5">
    <h1 class="text-center">
      BAB IV
      <br>
      PENYELENGGARAAN URUSAN PEMERINTAHAN DAERAH
    </h1>
    <br>  
    <!-- Urusan mulai loop -->
    @define($_bab=-1)
    @foreach($daftar_urusan as $idu=>$urusan)
      @define($bab=explode('.',$urusan->no)[0])
      @define($no=explode('.',$urusan->no)[1])
      @if($_bab!=$bab)
        @if($bab==1)
          <h2>A. URUSAN WAJIB YANG DILAKSANAKAN</h2>
        @elseif($bab==2)
          <h2>B. URUSAN PILIHAN</h2>
        @elseif($bab==3)
          <h2>C. FUNGSI PENUNJANG</h2>
        @endif
      @endif
      @define($_bab=$bab)

      <h3 class="text-uppercase @if($no>1 && count($pengguna)>1) break-page @endif">
        <mark>{{$no}}</mark>.
        <mark>{{$urusan->urusan}}</mark>
      </h3>
      
      <!-- Mulai Deskripsi -->
      @if(!empty($urusan->pengisi))
        @foreach($urusan->pengisi as $idp=>$pengisi)
          <h3 class="text-uppercase @if($idp) break-page @endif">
            <mark>{{$no}}</mark>.<mark>{{$idp+1}}</mark>. 
            <mark>{{$pengguna[$pengisi->id_user]}}</mark>
          </h3>
          <h3>a. Tujuan</h3>
          @foreach($daftar_deskripsi as $idd=>$deskripsi)
            @if($deskripsi->id_user==$pengisi->id_user)
            <div class="indent">
              <mark>{{$deskripsi->tujuan}}</mark>
            </div>
            @endif
            <br>
          @endforeach
        @endforeach
      @endif
      <!-- Akhir loop deskripsi -->
          
      <h3>b. Sasaran</h3>
      <div class="indent">
        <div class="text-center">
          <b>
            Tabel Realisasi Indikator Kinerja 
            <mark>{{$pengguna[$pengisi->id_user]}}</mark>
            Tahun 
            <mark>{{$logged->tahun}}</mark>
          </b>
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
          <!-- Mulai loop sasaran -->
          @foreach($daftar_sasaran as $ids=>$sasaran)
            @if($sasaran->id_user==$pengisi->id_user)
              @if(!empty($sasaran->sasaran_indikator))
                @foreach($sasaran->sasaran_indikator as $i)
                <tr>
                  <td><mark>{{$sasaran->sasaran}}</mark></td>
                  <td><mark>{{$i->indikator}}</mark></td>
                  <td class="text-center"><mark>{{$i->target}}</mark></td>
                  <td class="text-center"><mark>{{$i->realisasi}}</mark></td>
                  <td class="text-center"><mark>{{$i->persentase}}</mark></td>
                </tr>
                @endforeach
              @endif
            @endif
          @endforeach
          <!-- Akhir loop sasaran -->
          </tbody>
        </table>
        
        <p>
          Pada Tahun 
          <mark>{{$logged->tahun}}</mark>
          kinerja 
          <mark>{{$pengguna[$pengisi->id_user]}}</mark>
          yang telah dicapai berdasarkan masing-masing sasaran adalah sebagai berikut:
        </p>
        
        @define($_ids='')
        @foreach($daftar_sasaran as $ids=>$sasaran)
          @if($sasaran->id_user==$pengisi->id_user)
            @if($_ids!==$ids)
              <p>
                <b>Sasaran <mark>{{$ids+1}}</mark> :</b>
                <mark>{{$sasaran->sasaran}}</mark>, 
                ditetapkan 
                <mark> 
                @if(!empty($sasaran->sasaran_indikator))
                  {{count($sasaran->sasaran_indikator)}}
                @else 0 @endif 
                </mark>  
                indikator kinerja yaitu:
              </p>
            @endif
            @define($_ids=$ids)
            @if(!empty($sasaran->sasaran_indikator))
              @foreach($sasaran->sasaran_indikator as $si)
                <p class="list">
                  Indikator Sasaran 
                  <mark>{{$si->indikator}}</mark> 
                  pada tahun 
                  <mark>{{$urusan->id_tahun}}</mark> 
                  dengan target sebesar 
                  <mark>{{$si->target}}</mark>
                  dan terealisasi sebesar 
                  <mark>{{$si->realisasi}}</mark> 
                  atau 
                  <mark>{{$si->persentase}}</mark> 
                  persen; 
                </p>
              @endforeach
            @endif
          @endif
        @endforeach
      </div>
      
      
      <!-- Program dan kegiatan Loop -->
      <br>
      <h3>c. Program dan Kegiatan</h3>
      @foreach($daftar_program as $idp=>$program)
        @if($program->id_user==$pengisi->id_user)
        <div class="indent">
        <p>
          <mark><b>{{$program->program}}</b></mark> 
          dengan anggaran sebesar 
          <mark>Rp. {{$program->target}},-</mark> 
          dan terealisasi sebesar 
          <mark>Rp. {{$program->realisasi}},-</mark> 
          atau 
          <mark>{{$program->persentase}}</mark>. 
          Dengan indikator kinerja yaitu : 
        </p>
        @if(!empty($program->program_indikator))
        @foreach($program->program_indikator as $pi)
          <p class="list">
            Indikator Program <mark>{{$pi->indikator}}</mark> dengan target <mark>{{$pi->target}}</mark> dan <mark>{{$pi->realisasi}}</mark>. ({{$pi->persentase}})
          </p>
        @endforeach
        @endif
        <br>
        <p>
          Program tersebut didukung oleh <mark>...</mark> kegiatan.
        </p>
        <ol>
        @foreach($daftar_kegiatan as $idk=>$kegiatan)
          @if($program->id==$kegiatan->id_program)
            <li> 
              <mark>{{$kegiatan->kegiatan}}</mark> 
              dengan anggaran sebesar 
              <mark>Rp. {{$kegiatan->target}},-</mark> 
              dan terealisasi sebesar 
              <mark>Rp. {{$kegiatan->realisasi}},-</mark> 
              atau 
              <mark>{{$kegiatan->persentase}}</mark>. 
              Dengan indikator kinerja yaitu :
            <ul>
              @if(!empty($kegiatan->kegiatan_indikator))
                @foreach($kegiatan->kegiatan_indikator as $ki)                
                <li>
                  <mark>{{$ki->indikator}}</mark> 
                  dengan target sebesar 
                  <mark>{{$ki->target}}</mark> 
                  dan realisasi sebesar 
                  <mark>{{$ki->realisasi}}</mark>. 
                  <mark>{{$ki->persentase}}</mark>
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
      
      @foreach($daftar_deskripsi as $idd=>$deskripsi)
        @if($deskripsi->id_user==$pengisi->id_user)
        <br>
        <h3>d. Permasalahan dan Solusi</h3>
        <div class="indent">
          <p><b>Permasalahan :</b></p>
          <p><mark>{{$deskripsi->permasalahan}}</mark></p>
          <p><b>Solusi :</b></p>
          <p><mark>{{$deskripsi->solusi}}</mark></p>
        </div>
        
        <br>
        <h3>e. Penghargaan Nasional</h3>
        <div class="indent">
          <p><mark>{{$deskripsi->penghargaan}}</mark></p>
        </div>
      @endif
      
    @endforeach
    @endforeach
    <!-- Urusan berhenti -->
  </div>
</body>
</html>