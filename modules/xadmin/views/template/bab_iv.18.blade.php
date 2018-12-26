<style>
.text-center{
  text-align:center;
}
</style>

<h1 class="text-center">BAB IV</h1>
<h1 class="text-center">PENYELENGGARAAN URUSAN PEMERINTAHAN DAERAH</h1>
<br>
<h3>A. URUSAN WAJIB YANG DILAKSANAKAN</h3>

@foreach($daftar_urusan as $u)
  <h4>1. BIDANG {{$u->urusan}}</h4>
  <h4>1.1. {{$u->instansi}}</h4>
  <h4>a. Tujuan</h4>
  <p>{{$u->tujuan}}</p>
  <h4>b. Sasaran</h4>
  <b class="text-center">Tabel Realisasi Indikator Kinerja Sasaran Tahun {{$u->tahun}}</b>
  <table>
  <thead>
    <th>SASARAN</th>
    <th>INDIKATOR KINERJA</th>
    <th>TARGET</th>
    <th>REALISASI</th>
    <th>PERSENTASE</th>
  </thead>
  <tbody>
  @foreach($daftar_sasaran as $s)
    @foreach($s->sasaran_indikator as $i)
    <td>{{$s->sasaran}}</td>
    <td>{{$i->indikator}}</td>
    <td>{{$i->target}}</td>
    <td>{{$i->realisasi}}</td>
    <td>{{$i->persentase}}</td>
    @endforeach
  @endforeach
  </tbody>
  </table>
  <p>Pada Tahun {{$u->tahun}} kinerja {{$u->instansi}} yang telah dicapai berdasarkan masing-masing sasaran adalah sebagai berikut:</p>
  @foreach($daftar_sasaran as $s)
    @foreach($s->sasaran_indikator as $i)
  <p><b>Sasaran :</b> {{$s->sasaran}} , ditetapkan {{count($s->sasaran_indikator)}} indikator kinerja yaitu:
    <p>Indikator {{$i->indikator}} pada tahun {{$u->tahun}} dengan target sebesar {{$i->target}} dan terealisasi sebesar {{$i->realisasi}} atau {{$i->persentase}} persen; </p>
    @endforeach
  @endforeach
@endforeach



