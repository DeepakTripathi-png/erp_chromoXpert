@extends('Admin.Layouts.layout')
@section('meta_title', 'Test Components | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            {{-- Hero Header --}}
            <div class="p-4 rounded-4  position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Tests & Components</h2>
                <p class="mb-0">Manage test results and component details</p>

                  <div class="mt-3 mb-3 text-right">
                    <a href="{{ url()->previous() }}" 
                        class="btn btn-light btn-lg mt-3 fw-semibold rounded-pill shadow-sm"
                        style="background: #f6b51d; color: #1f2937; border: none;">
                            <i class="mdi mdi-arrow-left me-2"></i> Back
                    </a>
                    
               </div>
       
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-flask"></i>
                </div>
            </div>

            
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <div class="mt-3 mb-3 display-flex gap-2">
                    <a href="#" class="btn btn-light btn-lg fw-semibold rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#animalInfoModal"
                    style="background: #f6b51d; color: #1f2937; border: none;">
                        <i class="mdi mdi-paw me-2"></i> Animal Info
                    </a>
                    <a href="{{url('admin/reports/view')}}" class="btn btn-light btn-lg fw-semibold rounded-pill shadow-sm"
                    style="background: #cc235e; color: #fff; border: none;">
                        <i class="mdi mdi-file-pdf me-2"></i> Print Report
                    </a>
                </div>
            </div>
        </div>

            {{-- Tab Navigation --}}
            <ul class="nav nav-tabs mb-3" style="border: none;">
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-bold active" href="#tests" data-bs-toggle="tab">
                        Test
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-bold" href="#testCompo" data-bs-toggle="tab">
                        Test Compo
                    </a>
                </li>
            </ul>


         

            {{-- Glassmorphic Card --}}
            <div class="card border-0 shadow-lg rounded-4"
                 style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
                <div class="card-body p-3">
                    <div class="tab-content">

                        {{-- Tests Tab --}}
                        <div class="tab-pane fade show active" id="tests">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle mb-0">
                                    <thead style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%); color: #fff;">
                                        <tr>
                                            <th>Name</th>
                                            <th>Unit</th>
                                            <th>Reference Range</th>
                                            <th>Result</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <tr>
                                            <td colspan="5" class="text-start fw-bold">Component Title</td>
                                        </tr>
                                        <tr>
                                            <td>test compo</td>
                                            <td>EA</td>
                                            <td>100-200</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" />
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm">
                                                    <option value="" selected>Select status</option>
                                                    <option value="normal">Normal</option>
                                                    <option value="abnormal">Abnormal</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <textarea class="form-control form-control-sm" rows="3" placeholder="Comment"></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-lg rounded-pill shadow-sm"
                                        style="background: #6267ae; color: #fff; border: none;">
                                    <i class="bi bi-check-lg me-2"></i> Save
                                </button>
                            </div>
                        </div>

                        {{-- Test Compo Tab --}}
                        <div class="tab-pane fade" id="testCompo">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle mb-0">
                                    <thead style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%); color: #fff;">
                                        <tr>
                                            <th>Name</th>
                                            <th>Unit</th>
                                            <th>Reference Range</th>
                                            <th>Result</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="text-start fw-bold">Component Title</td>
                                        </tr>
                                        <tr>
                                            <td>test compo</td>
                                            <td>EA</td>
                                            <td>100-200</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" />
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm">
                                                    <option value="" selected>Select status</option>
                                                    <option value="normal">Normal</option>
                                                    <option value="abnormal">Abnormal</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <textarea class="form-control form-control-sm" rows="3" placeholder="Comment"></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-lg rounded-pill shadow-sm"
                                        style="background: #6267ae; color: #fff; border: none;">
                                    <i class="bi bi-check-lg me-2"></i> Save
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Animal Info Modal -->
<div class="modal fade" id="animalInfoModal" tabindex="-1" aria-labelledby="animalInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4" style="background: rgba(255,255,255,0.85); backdrop-filter: blur(14px);">
            <div class="modal-header" style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h5 class="modal-title" id="animalInfoModalLabel">Animal Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-2"><strong>Name:</strong> dog</p>
                <p class="mb-2"><strong>Gender:</strong> Male</p>
                <p class="mb-2"><strong>Date of birth:</strong> 03-09-2021</p>
                <p class="mb-2"><strong>Age:</strong> 3 Years</p>
                <p class="mb-2"><strong>Owner name:</strong> 650492804</p>
                <p class="mb-2"><strong>Phone:</strong> 650492804</p>
                <p class="mb-2"><strong>Email:</strong> owner@test.com</p>
                <p class="mb-2"><strong>Address:</strong> text</p>
            </div>
            <div class="modal-footer" style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%);">
                <button type="button" class="btn btn-light rounded-pill shadow-sm" style="background: #fff; color: #6267ae; border: none;" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('style')
<style>
    /* Tabs */
    .nav-tabs .nav-link.active {
        background: #fff !important;
        color: #6267ae !important;
        border: none !important;
        font-weight: 700;
    }
    .nav-tabs .nav-link { color: #fff !important; border-radius: 0 !important; }

    /* Table */
    table.table td, table.table th {
        padding: 8px 10px !important;
        vertical-align: middle !important;
        font-size: 0.9rem;
    }
    .form-control-sm, .form-select-sm {
        font-size: 0.9rem;
        border-radius: 4px;
        border: 1px solid #f6b51d;
        color: #6267ae;
        background: #fff;
    }
    .form-control-sm::placeholder { color: #999; }

    /* Buttons */
    button.btn-lg {
        transition: all 0.2s ease-in-out;
    }
    button.btn-lg:hover { opacity: 0.9; }

    /* Switch Toggle */
    .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 24px; }
    .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
    input:checked + .slider { background: linear-gradient(135deg, #6267ae 0%, #f6b51d 100%); box-shadow: 0 0 10px #f6b51d; }
    input:checked + .slider:before { transform: translateX(20px); }
</style>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var triggerTabList = [].slice.call(document.querySelectorAll('.nav-link'))
        triggerTabList.forEach(function(triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function(e) {
                e.preventDefault()
                tabTrigger.show()
            })
        })
    })
</script>
@endsection
