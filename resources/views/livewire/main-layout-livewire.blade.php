<div>
    @if (session()->has('success'))
        <div class="bg-success">
            {{ session('success')}}
        </div>
    @endif
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card">
                        <div class="card-body p-5">
                            <form wire:submit='createNewTask' class="d-flex justify-content-center align-items-center mb-4">
                                @csrf
                                <div class="form-outline flex-fill">
                                    <input wire:model='name' type="text" id="form2" class="form-control" />
                                    <label class="form-label" for="form2">New task...</label>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                    <textarea wire:model='description' class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-info ms-2">Add</button>
                            </form>
                            <!-- Tabs navs -->
                            <ul class="nav nav-tabs mb-4 pb-2" id="ex1" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a wire:click='setFilter("all")' class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1"
                                        role="tab" aria-controls="ex1-tabs-1" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a wire:click='setFilter("done")' class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2"
                                        role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Done</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a wire:click='setFilter("not_completed")' class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3"
                                        role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Not Completed</a>
                                </li>
                            </ul>
                            <!-- Tabs navs -->

                            <!-- Tabs content -->
                            <div class="tab-content" id="ex1-content">
                                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                                    aria-labelledby="ex1-tab-1">
                                    <ul class="list-group mb-0">
                                        @forelse ($tasks as $task)
                                            <x-list-item :task="$task" />
                                        @empty
                                            <p>No tasks till now</p>
                                        @endforelse
                                        {{-- <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded"
                                            style="background-color: #f4f6f7;">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                aria-label="..." checked />
                                            <s>Dapibus ac facilisis in</s>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded"
                                            style="background-color: #f4f6f7;">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                aria-label="..." />
                                            Morbi leo risus
                                        </li>
                                        <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded"
                                            style="background-color: #f4f6f7;">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                aria-label="..." />
                                            Porta ac consectetur ac
                                        </li>
                                        <li class="list-group-item d-flex align-items-center border-0 mb-0 rounded"
                                            style="background-color: #f4f6f7;">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                aria-label="..." />
                                            Vestibulum at eros
                                        </li> --}}
                                    </ul>
                                </div>
                                {{-- <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                    <ul class="list-group mb-0">
                                        <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded"
                                            style="background-color: #f4f6f7;">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                aria-label="..." />
                                            Morbi leo risus
                                        </li>
                                        <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded"
                                            style="background-color: #f4f6f7;">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                aria-label="..." />
                                            Porta ac consectetur ac
                                        </li>
                                        <li class="list-group-item d-flex align-items-center border-0 mb-0 rounded"
                                            style="background-color: #f4f6f7;">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                aria-label="..." />
                                            Vestibulum at eros
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel"
                                    aria-labelledby="ex1-tab-3">
                                    <ul class="list-group mb-0">
                                        <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded"
                                            style="background-color: #f4f6f7;">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                aria-label="..." checked />
                                            <s>Cras justo odio</s>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded"
                                            style="background-color: #f4f6f7;">
                                            <input class="form-check-input me-2" type="checkbox" value=""
                                                aria-label="..." checked />
                                            <s>Dapibus ac facilisis in</s>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                            <!-- Tabs content -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

