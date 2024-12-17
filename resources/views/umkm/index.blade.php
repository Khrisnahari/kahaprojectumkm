@extends('template')
@section('title', 'Pasar Digital Darmasaba - Data UMKM')
@section('content')
<div class="d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-8">
                <h5 class="card-title fw-semibold mb-4">Data UMKM</h5>
              </div>
              <div class="col-4">
                <a href="{{route('umkm.create')}}" style="margin-left:60%;" class="btn btn-primary fs-4 mb-4 rounded-2"><span class="ti ti-plus"></span> UMKM</a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">No</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Nama UMKM</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Kategori UMKM</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Alamat</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Status</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Actions</h6>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($umkms as $umkm)
                    <tr>
                      <td class="border-bottom-0">
                        <p class="fw-semibold mb-0 fw-normal">{{ $no++ }}</p>
                      </td>
                      <td class="border-bottom-0">
                        <p class="fw-semibold mb-0 fw-normal">{{ $umkm->nama_umkm }}</p>
                      </td>
                      <td class="border-bottom-0">
                        <p class="fw-semibold mb-0 fw-normal">{{ $umkm->kategori }}</p>
                      </td>
                      <td class="border-bottom-0">
                        <p class="fw-semibold mb-0 fw-normal">{{ $umkm->alamat }}</p>
                      </td>
                      <td class="border-bottom-0">
                        <div class="d-flex align-items-center gap-2">
                          <span class="badge bg-status-danger rounded-3 fw-semibold">{{ $umkm->status }}</span>
                        </div>
                      </td>
                      <td class="border-bottom-0">
                        <form id="deleteForm" action="{{ route('umkm.destroy', $umkm->id) }}" method="POST">
                          <a href="{{ route('umkm.show', $umkm->id) }}" class="btn btn-sm btn-dark">Detail</a>
                            {{-- <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">EDIT</a> --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm bg-status-danger" style="color: white" onclick="confirmDelete(event)">Delete</button>
                        </form>
                      </td>
                    </tr> 
                    @empty
                      <div class="alert alert-danger">
                          Data UMKM belum Tersedia.
                      </div>
                  @endforelse                       
                </tbody>
              </table>
              {{ $umkms->links() }}
            </div>
          </div>
        </div>
      </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(event) {
      event.preventDefault(); // Mencegah form untuk submit langsung

      // Menggunakan SweetAlert untuk konfirmasi
      Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: "Data yang dihapus tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          cancelButtonText: 'Batal',
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              // Jika diklik 'Hapus', kirimkan form
              document.getElementById('deleteForm').submit();
          }
      });
  }
</script>
<script>
  //message with sweetalert
  @if(session('success'))
      Swal.fire({
          icon: "success",
          title: "BERHASIL",
          text: "{{ session('success') }}",
          showConfirmButton: false,
          timer: 2000
      });
  @elseif(session('error'))
      Swal.fire({
          icon: "error",
          title: "GAGAL!",
          text: "{{ session('error') }}",
          showConfirmButton: false,
          timer: 2000
      });
  @endif

</script>
@endsection