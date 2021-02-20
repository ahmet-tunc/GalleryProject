@extends('layouts.admin.admin')

@section('title')
    <?php
    if (isset($news))
    {
        $title = "Haber Düzenleme";
        $postIsset = true;
        $route = route('admin.newsUpdate', ['id' => $news->id]);
    }
    else
    {
        $title = "Haber Ekleme";
        $postIsset = false;
        $route = route('admin.newsAdd');
    }
    ?>

    {{$title}}
@endsection

@section('css')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <h5>Yeni Haber Yazısı Ekle</h5>
                </div>
            </div>
            <div class="panel-body p-20">
                <form method="POST" id="frmPost" action="{{$route}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$postIsset?$news->id:''}}" name="id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="title">Haber Başlığı</label>
                                <input type="text" class="form-control" name="title" id="title"
                                       value="{{$postIsset?$news->title:''}}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="image">Kapak Resmi</label>
                                <input type="{{$postIsset?'text':'file'}}" onfocus="this.type='file'" class="form-control" id="image" name="image"
                                       value="{{$postIsset?$news->path:''}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="description">Açıklama</label>
                                <textarea name="description" id="description" style="width: 100%" cols="70" rows="5">{{$postIsset?$news->description:''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group">
                                <textarea name="text" id="text" rows="10" cols="70">{{$postIsset?$news->content:''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group">
                                <label>
                                    <input type="checkbox" name="status" {{ $postIsset ? ($news->status ?'checked':''):''}}>
                                    Aktif / Pasif
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" id="btnSave">Kaydet</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function ()
        {

            $(function ($)
            {
                CKEDITOR.replace('text');
            });

            $('#btnSave').click(function ()
            {
                let name = $('#title').val();
                let image = $('#image').val();
                let content = CKEDITOR.instances['text'].getData();
                console.log(content);
                if (name == '')
                {
                    Swal.fire({
                        title: 'Hata!',
                        text: 'Resim adı boş bırakılamaz.',
                        icon: 'error',
                        confirmButtonText: 'Tamam'
                    });
                }
                else if (content == '')
                {
                    Swal.fire({
                        title: 'Hata!',
                        text: 'Habere ait içerik boş bırakılamaz.',
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
                    $('#frmPost').submit();
                }

            });
        });
    </script>
@endsection
