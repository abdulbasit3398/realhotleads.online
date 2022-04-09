<!-- Start Directory Modal -->
<div class="modal fade" id="directoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('create-directory')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Directory</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Directory Name</label>
                            <input required type="text" name="directory_name" id="directory_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="openModal()">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </div>
        </form>
    </div>
</div>
<!-- End Directory Modal -->

<div class="d-xl-flex" id="Cloud" name="Cloud">
    <div class="w-100">
        <div class="d-md-flex">
            <div class="card filemanager-sidebar me-md-2">
                <h4 class="card-title pt-3 px-3">Cloud</h4>
                <div class="card-body">

                    <div class="d-flex flex-column h-100">
                        <div class="mb-4">
                            <div class="mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-light w-100"
                                            type="button" data-toggle="modal" onClick="openModal()">
                                        <i class="mdi mdi-plus me-1"></i> Create New Directory
                                    </button>

                                </div>
                            </div>
                            <ul class="list-unstyled categories-list">
                                <li>
                                    <div class="custom-accordion">
                                        <a class="text-body fw-medium py-1 d-flex align-items-center"
                                           data-bs-toggle="collapse" href="#categories-collapse" role="button"
                                           aria-expanded="false" aria-controls="categories-collapse">
                                            <i class="mdi mdi-folder font-size-16 text-warning me-2"></i> Folders <i
                                                class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                        </a>
                                        <div class="collapse show" id="categories-collapse">
                                            <div class="card border-0 shadow-none ps-2 mb-0">
                                                <ul class="list-unstyled mb-0">

                                                    @foreach($directories as $directory)
                                                        <?php
//                                                        $metadata = Storage::disk('gdrive')->getAdapter()->getMetadata($folderId);

                                                        $dir_meta = \Illuminate\Support\Facades\Storage::disk('google')->getMetadata($directory);;
                                                        ?>
                                                        <li class="dir_{{$directory}}"><a href="#"
                                                                                          class="d-flex align-items-center"><span
                                                                    class="me-auto">{{$dir_meta['name']}}</span></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-auto">
                            <form action="{{route('upload-to-root')}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <label>Upload to Root</label>
                                <input type="file" class="form-control" name="file" id="file">
                                <button class="btn btn-outline-secondary mt-2" type="submit">
                                    <i class="mdi mdi-upload m-1"></i>
                                    Upload</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <div class="w-100">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row mb-3">
                                <div class="col-xl-8 col-sm-6">
                                    <div class="mt-2">
                                        <h5>My Files</h5>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-sm-6">


                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="row">
                                @foreach($directories as $directory)

                                    <?php
                                    $dir_meta = \Illuminate\Support\Facades\Storage::disk('google')->getMetadata($directory);
                                    $c = collect(\Illuminate\Support\Facades\Storage::disk('google')
                                        ->listContents($dir_meta['path'], false))
                                        ->where('type', '=', 'file');
                                    $file_count = count($c);
                                    ?>

                                    <div class="col-xl-4 col-sm-6 dir_{{$directory}} collapsed" data-bs-toggle="collapse"
                                         href="#collapse_{{$directory}}" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="card shadow-none border">
                                            <div class="card-body p-3">
                                                <div class="">
                                                    <div class="float-end ms-2">
                                                        <div class="dropdown mb-2">
                                                            <a class="font-size-16 text-muted dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
{{--                                                                <a class="dropdown-item">Open</a>--}}
{{--                                                                <div class="dropdown-divider"></div>--}}
                                                                <a class="dropdown-item" onclick="removeDirectory('{{$directory}}')">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-xs me-3 mb-3">
                                                        <div class="avatar-title bg-transparent rounded">
                                                            <i class="bx bxs-folder font-size-24 text-warning"></i>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="overflow-hidden me-auto">
                                                            <h5 class="font-size-14 text-truncate mb-1"><a href="javascript: void(0);" class="text-body">{{$dir_meta['name']}}</a></h5>
                                                            <p class="text-muted text-truncate mb-0">{{$file_count}} Files</p>
                                                        </div>
                                                        <div class="align-self-end ms-2">
{{--                                                            <p class="text-muted mb-0">{{$dir_meta['size']}}</p>--}}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                @foreach($directories as $directory)
                                    <?php
                                    $dir_meta = \Illuminate\Support\Facades\Storage::disk('google')->getMetadata($directory);
                                    $path = '/'.$dir_meta['path'];
                                    $these_files = collect(\Illuminate\Support\Facades\Storage::disk('google')
                                        ->listContents($dir_meta['path'], false))
                                        ->where('type', '=', 'file');
                                    ?>

                                    <div class="col-12 collapse mb-2" id="collapse_{{$directory}}">
                                        <div class="d-flex flex-wrap  mt-3">
                                            <h5 class="font-size-16 m-3">Files in {{$dir_meta['name']}}</h5>
                                            <div class="ms-auto">
                                                <form action="{{route('put-in-dir')}}" method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" name="dir_name" value="{{$dir_meta['name']}}">
                                                        <input type="file" class="form-control" name="dir_file" id="dir_file">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-outline-secondary" type="submit"><i class="mdi mdi-upload m-1"></i>
                                                                Upload</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col" colspan="2">Size</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $a=0;
                                                ?>
                                                @forelse($these_files as $file_meta)
                                                    <?php
                                                    //                                                        $meta = \Illuminate\Support\Facades\Storage::disk('google')->getMetadata($file_id);
                                                    //                                                        $response = \Illuminate\Support\Facades\Storage::disk('google')->download($file_id);
                                                    $ext = $file_meta['extension'];
                                                    $a++;

                                                    $icon = 'file-document';
                                                    if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'raw'){
                                                        $icon = 'image';
                                                    }


                                                    $size = \App\Services\CloudService::formatSize($file_meta['size']);

                                                    ?>
                                                    <tr  id="recent_file_{{$file_meta['basename']}}">
                                                        <td>{{$a}}</td>
                                                        <td onclick="findUrl('{{$file_meta['basename']}}')"><a href="javascript: void(0);" class="text-dark fw-medium">
                                                                <i class="mdi mdi-{{$icon}} font-size-16 align-middle text-primary me-2"></i>{{$file_meta['name']}}</a></td>
                                                        <td>{{\Carbon\Carbon::parse($file_meta['timestamp'])->format('d-m-y h:i a')}}</td>
                                                        <td>{{$size}}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="font-size-16 text-muted dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                    <i class="mdi mdi-dots-horizontal"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <a class="dropdown-item" target="_blank" onclick="findUrl('{{$file_meta['basename']}}')">Open</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" onclick="removeFile('{{$file_meta['basename']}}')" >Remove</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="4">No recent file</td>
                                                    </tr>

                                                @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                <div class="d-flex flex-wrap">
                                    <h5 class="font-size-16 m-3">Recent Files</h5>
                                </div>
                                <hr class="mt-2">

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-hover mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col" colspan="2">Size</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $b=0;
                                        ?>
                                            @forelse($drive_files as $file)
                                                <?php
                                                    $b++;
                                                    $meta = \Illuminate\Support\Facades\Storage::disk('google')->getMetadata($file);
                                                    $response = \Illuminate\Support\Facades\Storage::disk('google')->download($file);
                                                    $ext = $meta['extension'];


                                                    $icon = 'file-document';
                                                    if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'raw'){
                                                        $icon = 'image';
                                                    }


                                                    $size = \App\Services\CloudService::formatSize($meta['size'])

                                                ?>


                                            <tr  id="recent_file_{{$file}}">
                                                <td>{{$b}}</td>

                                                    <td onclick="findUrl('{{$file}}')"><a href="javascript: void(0);" class="text-dark fw-medium">
                                                            <i class="mdi mdi-{{$icon}} font-size-16 align-middle text-primary me-2"></i>{{$meta['name']}}</a></td>
                                                    <td>{{\Carbon\Carbon::parse($meta['timestamp'])->format('d-m-y h:i a')}}</td>
                                                    <td>{{$size}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="font-size-16 text-muted dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                                <i class="mdi mdi-dots-horizontal"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" target="_blank" onclick="findUrl('{{$file}}')">Open</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" onclick="removeFile('{{$file}}')">Remove</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="text-center">
                                                    <td colspan="4">No recent file</td>
                                                </tr>

                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>


        function findUrl(file){
            loadingStart();
            $.ajax({
                url:'{{route('file-url')}}',
                data:{file},
                success:(url)=>{
                    if(url){
                        loadingStop();
                        window.open(url, '_blank');
                    }
                }
            });

        }

        function removeFile(file){
            loadingStart();
            $.ajax({
                    url:'{{route('remove-file')}}',
                    method:'DELETE',
                    data:{file,'_token':'{{csrf_token()}}'},
                    success:(result)=>{
                        if(result){
                            $('#recent_file_'+file).remove();
                            loadingStop();
                            displayMessage('File Removed');
                        }
                    }
                });
            }

        function removeDirectory(id){
            loadingStart();
            $.ajax({
                url:'{{route('remove-directory')}}',
                method:'DELETE',
                data:{id,'_token':'{{csrf_token()}}'},
                success:function (){
                    $('.dir_'+id).remove();
                    loadingStart();
                    displayMessage('Directory Removed');
                }
            })
        }

        function openModal(){
            $('#directoryModal').modal('toggle');
        }

        function displayMessage(message) {
            toastr.success(message, 'Event');
        }

    </script>
@endsection
