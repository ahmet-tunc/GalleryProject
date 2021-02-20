@extends('layouts.admin.admin')

@section('title')
    Haberler - Blog
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
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <h5>Haberler - Blog Listesi</h5>
                </div>
            </div>
            <div class="panel-body p-20">

                <table class="table table-hover table-bordered">
                    <div class="col-md-12 mb-15" style="margin:0; padding:0;">
                        <div class="row">
                            <div class="col-sm-4">
                                <a class="btn btn-success btn-block" href="{{route('admin.newsAddShow')}}">Ekle</a>
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
                        <th>Haber Adı</th>
                        <th>Ön Açıklama</th>
                        <th>Slug</th>
                        <th>Aktif / Pasif</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $item)
                        <tr id="{{$item->id}}" class="subGallery">
                            <td width="10%">
                                <input type="checkbox" name="check" class="checkControl"></td>
                            <td width="15%">
                                <img src="{{asset('storage/'.$item->path)}}" width="40px" height="40px">
                            </td>
                            <td width="20%">{{$item->title}}</td>
                            <td width="25%">{{$item->description}}</td>
                            <td width="20%">{{$item->slug}}</td>
                            <td width="10%">
                                @if($item->status)
                                    <a data-id="{{$item->id}}" class="btn btn-success changeStatus">AKTİF</a>
                                @else
                                    <a data-id="{{$item->id}}" class="btn btn-danger changeStatus">PASİF</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.newsGetById',['id'=>$item->id])}}"><i class="fa fa-cog"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div align="center">{{ $news->links('vendor.pagination.default') }}</div>
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
                            url: '{{route('admin.galleryEditOrder')}}',
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
                                url: '{{route("admin.newsDelete")}}',
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
                    $('#frmAddGallery').submit();
                }

            });


            //CHANGE STATUS
            $('.changeStatus').click(function ()
            {
                let self = $(this);
                let dataID = $(this).data('id');
                $.ajax({
                    url: '{{route('admin.newsChangeStatus')}}',
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
