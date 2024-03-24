@extends('layout.sidebar')
@section('galeri', 'active')
@section('title', 'Admin | Galeri')
@section('content')

   <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Galeri Kampung Budaya Polowijen</h4>
        <div class="card">
          <button
            type="button"
            class="btn btn-primary btn-lg mx-4 mb-4 mt-4"
            style="width: 200px;"
            data-bs-toggle="modal"
            data-bs-target="#tambahGaleri">
            Tambah Galeri
          </button>

          <!-- Modal -->
          <div class="modal fade" id="tambahGaleri" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('galeri.tambah') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Tambah Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Pilih Gambar</label>
                                    <input class="form-control" type="file" id="formFile" name="gambar" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Judul</label>
                                    <input type="text" id="nameBasic" class="form-control" name="judul" placeholder="Tambahkan Judul" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Deskripsi Galeri</label>
                                    <input type="text" id="nameBasic" class="form-control" name="deskripsi" style="height: 100px;" placeholder="Tambahkan Deskripsi" />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-6 mb-0">
                                    <label for="dobBasic" class="form-label">Time Stamp</label>
                                    <input type="text" id="dobBasic" class="form-control" name="timestamp" placeholder="12 / 02 / 2024" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
              </div>
            </div>
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>Gambar / Video</th>
                  <th>Judul</th>
                  <th>Deskripsi</th>
                  <th>Tanggal Upload</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <!-- Baris Isi Galeri -->
                @foreach($galeri as $item)
                <tr>
                  <td>

                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                        <li
                            data-bs-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-bs-placement="top"
                            class="avatar avatar-xl pull-up mx-3"
                            title="">
                            <img src="{{ asset('images/'.$item->gambar) }}" alt="Avatar" />
                        </li>
                    </ul>
                    </td>
                    <td>
                        <i class="fab fa-angular fa-lg text-danger"></i>
                        <strong class="truncate-text">{{ $item->judul }}</strong>
                    </td>
                    <!-- Benahi lagi agar bisa fungsi buat cut judul jadi 2 kata saja -->
                    <td>{{ $item->deskripsi }}</td>
                    <td><span class="badge bg-label-primary me-1">{{ $item->created_at }}</span></td>
                    <td>
                        
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-edit-alt me-1"></i> More Preview</a
                          >
                          <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                          >
                          <a class="dropdown-item" href="javascript:void(0);"
                            ><i class="bx bx-trash me-1"></i> Delete</a
                          >
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach

                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!--/ Basic Bootstrap Table -->
      </div>
    </div>
@endsection
