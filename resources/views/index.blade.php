@extends('layouts.main')
@section('main-section')
<div class="container my-5">
  <form action="{{ url('/add') }}" method="POST">
      @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="Enter Title">
    </div>
    <div class="mb-3">
      <label for="desc" class="form-label">Description</label>
      <textarea class="form-control" name="desc" id="desc" rows="5" placeholder="Enter Your Note Here...">{{old('desc')}}</textarea>
    </div>
    @error('title')
    <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
      @enderror
      @error('desc')
      <div class="alert alert-danger" role="alert">
          {{$message}}
      </div>
      @enderror
    <input class="btn btn-primary" type="submit" value="Submit">
  </form>
  <hr>
  @isset($msg)
      {{$msg}}
  @endisset
  <div class="d-flex flex-wrap justify-content-between align-item-center">
      @isset ($note)
      @foreach ($note as $n)
      <div class="card my-3" style="width: 18rem;">
          <div class="card-body ">
            <h5 class="card-title">{{$n->title}}</h5>
            <p class="card-text">{{$n->description}}</p>
            <a href="" class="btn btn-primary mx-2 edit"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{$n->id}}" data-title="{{$n->title}}" data-desc="{{$n->description}}">Edit</a>
            <button class="btn btn-primary mx-2 delete-btn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="{{$n->id}}">
              Delete
          </button>
          </div>
      </div> 
      @endforeach
      @endisset
      
      
      {{-- delete module --}}
      <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      Are you sure you want to delete this note?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <a href="" id="confirmDeleteBtn" class="btn btn-primary">Delete</a>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ url('/edit') }}" method="POST">
                      @csrf
                    <div class="mb-3">
                      <label for="etitle" class="form-label">Title</label>
                      <input type="hidden" name="eid" id="eid">
                      <input type="text" name="etitle" class="form-control" value="{{old('title')}}" id="etitle" placeholder="Enter Title" required>
                    </div>
                    <div class="mb-3">
                      <label for="edesc" class="form-label">Description</label>
                      <textarea class="form-control" name="edesc" id="edesc" rows="5" placeholder="Enter Your Note Here..." required>{{old('desc')}}</textarea>
                    </div>
                    @error('title')
                      <div class="alert alert-danger" role="alert">
                          {{$message}}
                          </div>
                          @enderror
                          @error('desc')
                          <div class="alert alert-danger" role="alert">
                              {{$message}}
                          </div>
                          @enderror
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" value="Save Changes" class="btn btn-primary">
              </div>
          </form>
            </div>
          </div>
        </div>
  </div>
</div>


    <script>
        document.addEventListener("DOMContentLoaded",function(){
            const editBtns = document.querySelectorAll(".edit");
            editBtns.forEach(btn=>{
                btn.addEventListener("click",function(){
                    const id = this.getAttribute("data-id");
                    const title = this.getAttribute('data-title');
                    const desc = this.getAttribute('data-desc');
                    document.getElementById("eid").value = id;
                    document.getElementById("etitle").value = title;
                    document.getElementById("edesc").value = desc;

                });
            });

        const deleteBtn = document.querySelectorAll(".delete-btn");
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        deleteBtn.forEach(button => {
            button.addEventListener('click', function() {
                const noteId = this.getAttribute('data-id');
                confirmDeleteBtn.setAttribute('href', "{{ route('note.delete', ['id' => ':id']) }}".replace(':id', noteId));
            });
        });
        });
    </script>
@endsection