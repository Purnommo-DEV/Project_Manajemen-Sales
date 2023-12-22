@extends('Layout.master', ['title' => 'Form Survey'])
@section('nav')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Form/</a>
            </li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Form Survey</h6>
    </nav>
@endsection
@section('konten')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col profil-section" style="margin-bottom: 0% !important">
                <div class="col pb-10">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalFormTambahNamaSurvey">
                                Tambah
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalFormTambahNamaSurvey" tabindex="-1"
                                aria-labelledby="modalFormTambahNamaSurveyLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalFormTambahNamaSurveyLabel">Tambah Form
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.TambahFormSurvey') }}" method="POST"
                                            id="formTambahNamaForm">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label class="text-danger error-text name_error"></label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group" id="div-form-survey">
                                @foreach ($form_survey as $data_form_survey)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $data_form_survey->name }}
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            {{-- <button type="button" class="btn btn-sm btn-warning ubah_form"><i
                                                    class="fa fa-pen" id-form="{{ $data_form_survey->id }}"></i></button> --}}
                                            <button type="button" class="btn btn-sm btn-primary tambah_parameter"
                                                id-form="{{ $data_form_survey->id }}"><i class="fa fa-plus"></i></button>
                                            <button type="button" class="btn btn-sm btn-danger hapus_form"
                                                id-form="{{ $data_form_survey->id }}"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            {{-- UBAH FORM --}}
                            {{-- <div class="modal fade" id="modalFormUbahNamaSurvey" tabindex="-1"
                                aria-labelledby="modalFormUbahNamaSurveyLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalFormUbahNamaSurveyLabel">Ubah Form
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.UbahFormSurvey') }}" method="POST"
                                            id="formUbahNamaForm">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label class="text-danger error-text name_error"></label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- TAMBAH PARAMETER --}}
                            <div class="modal fade" id="modalTambaTambahParameterFormSurvey" tabindex="-1"
                                aria-labelledby="modalTambaTambahParameterFormSurveyLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalTambaTambahParameterFormSurveyLabel">
                                                Tambah Form
                                                Parameter
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.TambahFormSurveyParameter') }}" method="POST"
                                            id="formTambaTambahParameterFormSurvey">
                                            @csrf
                                            <input type="hidden" name="id" hidden>
                                            <div class="modal-body">


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Label</label>
                                                            <input type="text" name="name[0]" class="form-control">
                                                        </div>
                                                        <div class="input-group has-validation">
                                                            <label class="text-danger error-text name_error"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select name="category[0]" class="form-control">
                                                                <option value="" selected disabled>Select Input
                                                                    Category
                                                                </option>
                                                                <option value="text">Text</option>
                                                                <option value="number">Number</option>
                                                                <option value="datetime-local">Date</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-group has-validation">
                                                            <label class="text-danger error-text name_error"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="divTambahForm"></div>

                                                <div class="form-group d-flex justify-content-center">
                                                    <button type="button" class="btn btn-success rounded-3 btn-sm ml-1"
                                                        onclick="addQuestion()"><i class="fa fa-plus"></i>
                                                    </button>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#formTambahNamaForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('label.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                        });
                    } else if (data.status == 1) {
                        swal({
                                title: "Berhasil",
                                text: `${data.msg}`,
                                icon: "success",
                                buttons: true,
                                successMode: true,
                            }),
                            $("#modalFormTambahNamaSurvey").modal('hide')
                        $("#div-form-survey").load(location.href + " #div-form-survey>*", "");
                    }
                }
            });
        });

        $(document).on('click', '.hapus_form', function(event) {
            const id = $(event.currentTarget).attr('id-form');

            swal({
                title: "Yakin ?",
                text: "Menghapus Data ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {

                if (willDelete) {
                    $.ajax({
                        url: "/admin/hapus-form-survey/" + id,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 0) {
                                alert("Gagal Hapus")
                            } else if (response.status == 1) {
                                swal({
                                        title: "Berhasil",
                                        text: `${response.msg}`,
                                        icon: "success",
                                        successMode: true,
                                    }),
                                    $("#div-form-survey").load(location.href +
                                        " #div-form-survey>*", "");

                                $("#modalFormTambahNamaSurvey").modal('hide');
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.tambah_parameter', function(event) {
            const id = $(event.currentTarget).attr('id-form');
            $("#modalTambaTambahParameterFormSurvey").modal('show');
            $("#formTambaTambahParameterFormSurvey [name='id']").val(id)

            $('#formTambaTambahParameterFormSurvey').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('label.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('label.' + prefix + '_error').text(val[0]);
                                // $('span.'+prefix+'_error').text(val[0]);
                            });
                        } else if (data.status == 1) {
                            $("#modalTambaTambahParameterFormSurvey").modal('hide');
                            swal({
                                    title: "Berhasil",
                                    text: `${data.msg}`,
                                    icon: "success",
                                    successMode: true,
                                }),
                                location.reload();
                        }
                    }
                });
            });
        });

        var newId = 1;

        var kolom_form = jQuery.validator.format(`
            <div class="row">
                <div class="form-group d-flex justify-content-center">
                    <button type="button" class="btn btn-danger rounded-3 btn-sm ml-1 hapusKolomFormSurvey"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" name="name[{0}]" class="form-control">
                    </div>
                    <div class="input-group has-validation">
                        <label class="text-danger error-text name_error"></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category[{0}]" class="form-control">
                            <option value="" selected disabled>Select Input
                                Category
                            </option>
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="datetime-local">Date</option>
                        </select>
                    </div>
                    <div class="input-group has-validation">
                        <label class="text-danger error-text name_error"></label>
                    </div>
                </div>
            </div>
        `);

        $('#divTambahForm').on('click', '.hapusKolomFormSurvey', function(e) {
            e.preventDefault();
            newId--;
            $(this).parent().parent().remove();
        });

        function addQuestion() {
            $('#divTambahForm').append(kolom_form(newId));
            newId++;
        }
    </script>
@endsection
