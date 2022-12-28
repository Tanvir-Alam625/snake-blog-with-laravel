@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
           <div class="d-flex justify-content-between">
            <h6 class="card-title">All Posts</h6>
            {{-- ====================== --}}
            {{-- trash modal button  --}}
            {{-- ====================== --}}
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">Trash
                <sup class="badge badge-light">{{count($trashPosts)}}</sup>
            </button>
            {{-- ==================== --}}
            {{-- modal container  --}}
            {{-- ==================== --}}
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">All Trash Items</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($trashPosts as $trashPost)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{ $trashPost->post_title}}</td>
                                        <td>
                                        <a href=" {{ route('post.delete',['id'=>$trashPost->id])}}" class="btn btn-danger">Delete</a>
                                        <a href=" {{ route('post.restore',['id'=>$trashPost->id])}}" class="btn btn-success">Restore</a>
                                        </form>   
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <th class="text-center" colspan="3">No Data Found</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           </div>
            <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p>
            <div class="table-responsive">
              <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                  @if (count($posts)> 9)
                  <div class="row ">
                    {{-- ========================= --}}
                    {{-- show of post entries  --}}
                    {{-- ========================= --}}
                    <div class="col-sm-12 col-md-6">
                          <div class="dataTables_length" id="dataTableExample_length">
                              <label>Show entries <select name="dataTableExample_length" aria-controls="dataTableExample" class="custom-select custom-select-sm form-control">
                                  <option value="10">10</option>
                                  <option value="30">30</option>
                                  <option value="50">50</option>
                                  <option value="-1">All</option>
                                  </select>
                              </label>
                          </div>
                      </div>
                      {{-- ========================= --}}
                      {{-- filter post  --}}
                      {{-- ========================= --}}
                      <div class="col-sm-12 col-md-6 ">
                          <div id="dataTableExample_filter" class="dataTables_filter d-flex justify-content-end">
                              <label>
                                  <input type="search" class="form-control" placeholder="Search" aria-controls="dataTableExample">
                              </label>
                          </div>
                      </div>
                  </div>
                  @endif
                        
                {{-- ========================= --}}
                {{-- post table  --}}
                {{-- ========================= --}}
                  <div class="row">
                      <div class="col-sm-12">
                          <table id="dataTableExample" class="table dataTable no-footer" role="grid" aria-describedby="dataTableExample_info">
                            
                            {{-- ========================= --}}
                            {{-- table header  --}}
                            {{-- ========================= --}}
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 154.172px;">Serial No</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 244.625px;">Title</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 108.547px;">Status</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 45.7031px;">Category</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 106.375px;">
                                    Action
                                    </th>
                                </tr>
                                </thead>
                                
                                {{-- ========================= --}}
                                {{-- table body  --}}
                                {{-- ========================= --}}
                                <tbody>
                                   @forelse ($posts as $post)
                                   <tr class="odd">
                                        <td class="sorting_1">{{$posts->firstItem() + $loop->index}}</td>
                                        <td>{{$post->post_title}}</td>
                                        <td>{{$post->post_status}}</td>
                                        <td>{{$post->RelationWithCategory->name}}</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <form class="d-inline" action="{{route('post.destroy', ['post'=>$post->id])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                   @empty
                                   <tr>
                                    <th class="text-center" colspan="5">No Data Found</th>
                                </tr>
                                   @endforelse
                            </tbody>
                        </table>
                        </div>
                    </div>
                    {{-- =========================== --}}
                    {{-- pagination links  --}}
                    {{-- =========================== --}}
                    {{$posts->render()}}
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

