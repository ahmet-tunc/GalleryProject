@extends('layouts.admin.admin')

@section('title')
    Galeri
@endsection

@section('css')
    <style>
        th {
            text-align: center;
        }


        td {
            vertical-align: middle !important;
            text-align: center;
            align-items: center;
        }

    </style>
@endsection

@section('content')
    <?php $lastOrder = 0; ?>
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <h5>"{{$currentGallery->name}}" adlı galeriye ait resimler</h5>
                </div>
            </div>
            <div class="panel-body p-20">
                <p>Burada silme, güncelleme işleminin yanı sıra, toplu ekleme işlemi de yapabilirsiniz.
                Toplu ekleme işlemi sırasında, yazmış olduğunuz sıra numarasına ilk resim atanır. Sonraki resimler, sıra numaraları birer arttırılarak eklenir.</p>
                <table class="table table-hover table-bordered">
                    <div class="col-md-12 mb-15" style="margin:0; padding:0">
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                        data-target="#addModal">Ekle
                                </button>

                            </div>
                            <div class="col-sm-4 mt-sm-2">
                                <button type="button" class="btn btn-danger btn-block" id="btnDelete">Sil</button>

                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-primary btn-block" id="btnAll">Tümünü Seç</button>

                            </div>
                        </div>
                    </div>

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Resim</th>
                        <th>Adı</th>
                        <th>Açıklama</th>
                        <th>Sıra Numarası</th>
                        <th>Aktif / Pasif</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="dragDrop">
                    @foreach($gallery as $item)
                            <tr id="{{$item->id}}" class="subGallery">
                                <td width="10%">
                                    <input type="checkbox" name="check" class="checkControl"></td>
                                <td width="20%">
                                    <img src="{{asset('storage/'.$item->path)}}" width="40px" height="40px">
                                </td>
                                <td width="30%">{{$item->name}}</td>
                                <td width="30%">{{$item->description}}</td>
                                <td name="orderRow" id="order{{$item->order_id}}" align="center"
                                    width="20%">{{$item->order_id}}</td>
                                <?php
                                if ($item->order_id > $lastOrder)
                                {
                                    $lastOrder = $item->order_id;
                                }
                                ?>
                                <td width="20%">
                                    @if($item->status)
                                        <a data-id="{{$item->id}}" class="btn btn-success changeStatus">AKTİF</a>
                                    @else
                                        <a data-id="{{$item->id}}" class="btn btn-danger changeStatus">PASİF</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="update" data-id="{{$item->id}}" data-toggle="modal"
                                       data-target="#updateModal"><i class="fa fa-cog"></i></a>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
                <div align="center">{{ $gallery->links('vendor.pagination.default') }}</div>
            </div>
        </div>
    </div>




    <!-- Modal - ADD -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ekleme İşlemi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="panel-body p-5">
                        <form id="frmAddSubGallery" method="POST" action="{{route('admin.subGalleryAdd')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="parent" value="{{$id}}">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="name">Adı</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               autofocus="">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="image">Resim</label>
                                        <input type="file" class="form-control" id="image" name="image[]" multiple="multiple">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="description">Açıklama</label>
                                        <textarea name="description" id="description" cols="200"
                                                  style="max-height: 120px; min-height: 50px; min-width: 50px"
                                                  rows="5"></textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="orderid">Sıra Numarası</label>
                                        <input type="number" min="1" max="{{$lastOrder+1}}" value="{{$lastOrder+1}}"
                                               class="form-control" name="orderid" id="orderid">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="form-group col-sm-12" style="padding: 0; margin: 0">
                                                    <label for="status">Aktif / Pasif
                                                        <input type="checkbox" id="status" name="status">
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="button" id="btnSave" class="btn btn-primary btn-block">Kaydet</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">İptal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal - UPDATE-->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Güncelleme İşlemi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="frmUpdateGallery" method="POST" action="{{route('admin.subGalleryUpdate')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="editName">Adı</label>
                                    <input type="text" class="form-control" name="name" id="editName"
                                           autofocus="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editImage">Kapak Resmi</label>
                                    <input type="file" class="form-control" id="editImage" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="editDescription">Açıklama</label>
                                    <textarea name="description" id="editDescription" cols="200"
                                              style="max-height: 120px; min-height: 50px; min-width: 50px"
                                              rows="5"></textarea>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="editOrderid">Sıra Numarası</label>
                                    <input type="number" min="1" max="{{$lastOrder+1}}" value="{{$lastOrder+1}}"
                                           class="form-control" name="orderid" id="editOrderid">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group col-sm-12" style="padding: 0; margin: 0">
                                                <label for="status">Aktif / Pasif
                                                    <input type="checkbox" id="editStatus" name="status">
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>


                    </form>


                </div>
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="button" id="btnUpdate" class="btn btn-primary btn-block">Güncelle</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">İptal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
    <script>
        $(document).ready(function ()
        {

            $('.js-example-basic-single').select2({
                dropdownParent: $("#addModal")
            });

            $('.newGallery').click(function ()
            {
                if ($('.newGallery').is(':checked'))
                {
                    $('#parentSelect').attr('disabled', 'true');
                }
                else
                {
                    $('#parentSelect').removeAttr('disabled');
                }
            });

            //EDIT ORDER

            var newID, currentID, trID;
            $("#dragDrop").sortable({
                start: function (event, ui)
                {
                    newID = null;
                    currentID = null;
                    trID = null;
                    trID = ui.item[0].id;
                    console.log(trID);
                    currentID = $(ui.item).index() + 1;
                },
                update: function (event, ui)
                {
                    newID = $(ui.item).index() + 1;
                }, stop: function (event, ui)
                {

                    if (newID != null)
                    {
                        $.ajax({
                            method: 'POST',
                            url: '{{route('admin.subGalleryEditOrder')}}',
                            data: {
                                '_token': '{{csrf_token()}}',
                                'trID': trID,
                                'currentID': currentID,
                                'newID': newID
                            },
                            async: false,
                            success: function (response)
                            {
                                let orderRow = document.getElementsByName('orderRow');
                                for (let i = 0; i < orderRow.length; i++)
                                {
                                    orderRow[i].innerText = i + 1;
                                }
                            }
                        });
                    }

                }
            });


            //SELECT ALL
            let checkControl = true;
            $('#btnAll').click(function ()
            {
                let check = document.getElementsByName('check');
                if (check.length)
                {
                    if (checkControl)
                    {
                        for (let i = 0; i < check.length; i++)
                        {
                            check[i].checked = true;
                        }
                        $(this).removeClass('btn-primary');
                        $(this).addClass('btn-danger');
                        $(this).text('Seçimi Kaldır');
                        checkControl = false;
                    }
                    else
                    {
                        for (let i = 0; i < check.length; i++)
                        {
                            check[i].checked = false;
                        }
                        $(this).removeClass('btn-danger');
                        $(this).addClass('btn-primary');
                        $(this).text('Tümünü Seç');
                        checkControl = true;
                    }
                }
                else
                {
                    Swal.fire({
                        title: 'Hata!',
                        text: 'Seçilebilecek bir veri kaydı bulunamadı',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }


            });

            //DELETE
            $('#btnDelete').click(function ()
            {
                let check = document.getElementsByName('check');
                let arr = [];
                for (let i = 0; i < check.length; i++)
                {
                    if (check[i].checked)
                    {
                        arr.push(check[i].parentElement.parentElement.id);
                    }
                }
                if (arr.length > 0)
                {
                    Swal.fire({
                        title: 'Uyarı',
                        text: "Seçili verileri silmek istediğinize emin misiniz?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sil',
                        cancelButtonText: 'Vazgeç'
                    }).then((result) =>
                    {
                        if (result.isConfirmed)
                        {
                            $.ajax({
                                url: '{{route("admin.galleryDelete")}}',
                                method: 'POST',
                                data: {
                                    '_token': '{{csrf_token()}}',
                                    'id': arr
                                },
                                async: false,
                                success: function (response)
                                {
                                    for (let i = 0; i < arr.length; i++)
                                    {
                                        document.getElementById(arr[i]).remove();
                                    }
                                    let btnAll = $('#btnAll');
                                    btnAll.removeClass('btn-danger');
                                    btnAll.addClass('btn-primary');
                                    btnAll.text('Tümünü Seç');

                                    Swal.fire({
                                        title: 'Başarılı!',
                                        text: 'Veri silme işlemi başarıyla gerçekleştirildi.',
                                        icon: 'success',
                                        confirmButtonText: 'Tamam'
                                    });
                                },
                                error: function (error)
                                {

                                }
                            });
                        }
                    })

                }
                else
                {
                    Swal.fire({
                        title: 'Hata!',
                        text: 'Seçili veri bulunamadı.',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
            });

            //SAVE
            $('#btnSave').click(function ()
            {
                let name = $('#name').val();
                let image = $('#image').val();
                if (name == '')
                {
                    Swal.fire({
                        title: 'Hata!',
                        text: 'Resim adı boş bırakılamaz.',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
                else if (image == '')
                {
                    Swal.fire({
                        title: 'Hata!',
                        text: 'Lütfen bir resim seçiniz.',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
                else
                {
                    $('#frmAddSubGallery').submit();
                }

            });


            //CHANGE STATUS
            $('.changeStatus').click(function ()
            {
                let self = $(this);
                let dataID = $(this).data('id');
                $.ajax({
                    url: '{{route('admin.galleryChangeStatus')}}',
                    method: 'POST',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'id': dataID
                    },
                    async: false,
                    success: function (response)
                    {
                        let text;
                        if (self.hasClass('btn-danger'))
                        {
                            self.removeClass('btn-danger');
                            self.addClass('btn-success');
                            self.text('AKTİF');
                            text = dataID + ' id\'li verinin durumu aktif olarak değiştirildi';
                        }
                        else
                        {
                            self.removeClass('btn-success');
                            self.addClass('btn-danger');
                            self.text('PASİF');
                            text = dataID + ' id\'li verinin durumu pasif olarak değiştirildi';
                        }
                        Swal.fire({
                            title: 'Başarılı!',
                            text: text,
                            icon: 'success',
                            confirmButtonText: 'Tamam'
                        });

                    },
                    error: function (error)
                    {

                    }
                });
            });

            //IF NOT ALL CHECKBOXES ARE SELECTED
            $('.checkControl').click(function ()
            {
                let btnAll = $('#btnAll');
                btnAll.removeClass('btn-danger');
                btnAll.addClass('btn-primary');
                btnAll.text('Tümünü Seç');
            });


            //GET VALUE
            $('.update').click(function ()
            {
                let self = $(this);
                let id = $('#id');
                let name = $('#editName');
                let image = $('#editImage');
                let description = $('#editDescription');
                let orderID = $('#editOrderid');
                let status = $('#editStatus');
                let dataID = $(this).data('id');
                $.ajax({
                    url: '{{route('admin.galleryGetById')}}',
                    method: 'POST',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'id': dataID
                    },
                    async: false,
                    success: function (response)
                    {
                        id.val(response.data[0].id);
                        name.val(response.data[0].name);
                        image.attr('type', 'text');
                        image.val('storage/' + response.data[0].path);
                        image.click(function ()
                        {
                            image.attr('type', 'file');
                        });
                        description.val(response.data[0].description);
                        orderID.val(parseInt(response.data[0].order_id));
                        if (response.data[0].status)
                        {
                            status.attr('checked', true);
                        }
                        else
                        {
                            status.attr('checked', false);
                        }
                    },
                    error: function (error)
                    {

                    }
                })
            });


            //UPDATE
            $('#btnUpdate').click(function ()
            {
                let name = $('#editName').val();
                if (name == '')
                {
                    Swal.fire({
                        title: 'Hata!',
                        text: 'Resim adı boş bırakılamaz.',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
                else
                {
                    $('#frmUpdateGallery').submit();
                }
            });


        });

        @php
            //ERRORS
                if ($errors->any())
               {
                   $swalText = '';
                   foreach ($errors->all() as $error)
                   {
                       $swalText .= $error . '<br>';
                   }
               }
        @endphp

        @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Hata',
            html: '{!!  $swalText !!}',
        });
        @endif
    </script>
@endsection
