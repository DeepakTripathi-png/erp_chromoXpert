@extends('Admin.Layouts.layout')
@section('meta_title', 'Add New Registration | ChromoXpert')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%); color: #fff;">
                <h2 class="fw-bold mb-1">Add New Registration</h2>
                <p class="mb-0">Fill in the details to create a new appointment record</p>
                <a href="{{ url()->previous() }}" 
                   class="btn btn-light btn-lg mt-3 fw-semibold rounded-pill shadow-sm"
                   style="background: #f6b51d; color: #1f2937; border: none;">
                    <i class="mdi mdi-arrow-left me-2"></i> Back
                </a>
                <div class="position-absolute top-0 end-0 opacity-25" style="font-size: 120px; color: #ac7fb6;">
                    <i class="mdi mdi-calendar-check"></i>
                </div>
            </div>

            <div class="card border-0 shadow-lg rounded-4" 
                 style="background: rgba(255,255,255,0.95); backdrop-filter: blur(14px);">
                <div class="card-body p-4">

                    <form action="{{ url('admin/appointments/store') }}" method="POST" enctype="multipart/form-data"  novalidate >
                        @csrf
                        <div class="row g-4">
                            <!-- Appointment Details Section -->
                            <div class="col-12">
                                <h5 class="fw-bold mb-3" style="color: #6267ae;">Appointment Details</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select rounded-3 select2" id="lab_id" name="lab_id" required
                                            style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                        <option value="" {{ old('lab_id') ? '' : 'selected' }} disabled>Select Lab</option>
                                        <option value="1" {{ old('lab_id') == '1' ? 'selected' : '' }}>PetLab Diagnostics</option>
                                        <option value="2" {{ old('lab_id') == '2' ? 'selected' : '' }}>Animal Health Labs</option>
                                        <option value="3" {{ old('lab_id') == '3' ? 'selected' : '' }}>PetCare Diagnostics</option>
                                    </select>
                                    <label for="lab_id" style="color: #6267ae;">Lab*</label>
                                    @error('lab_id')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="form-floating flex-grow-1">
                                        <select class="form-select rounded-3 select2" id="referee_doctor_id" name="referee_doctor_id" required
                                                style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                            <option value="" {{ old('referee_doctor_id') ? '' : 'selected' }} disabled>Select Referee Doctor</option>
                                            <option value="1" {{ old('referee_doctor_id') == '1' ? 'selected' : '' }}>Dr. John Doe</option>
                                            <option value="2" {{ old('referee_doctor_id') == '2' ? 'selected' : '' }}>Dr. Jane Smith</option>
                                        </select>
                                        <label for="referee_doctor_id" style="color: #6267ae;">Referee Doctor*</label>
                                    </div>
                                    <button type="button" class="btn btn-outline-secondary rounded-end" data-bs-toggle="modal" data-bs-target="#addRefereeDoctorModal"
                                            style="border-color: #f6b51d; color: #6267ae;">
                                        <i class="mdi mdi-plus"></i>
                                    </button>
                                </div>
                                @error('referee_doctor_id')
                                    <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control rounded-3" id="appointment_date" 
                                           name="appointment_date" value="{{ old('appointment_date') }}" required
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="appointment_date" style="color: #6267ae;">Appointment Date*</label>
                                    @error('appointment_date')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="time" class="form-control rounded-3" id="appointment_time" 
                                           name="appointment_time" value="{{ old('appointment_time') }}" required
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="appointment_time" style="color: #6267ae;">Appointment Time*</label>
                                    @error('appointment_time')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pet Details Section -->
                            <div class="col-12 mt-4">
                                <h5 class="fw-bold mb-3" style="color: #6267ae;">Pet Details</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="form-floating flex-grow-1">
                                        <select class="form-select rounded-3 select2" id="pet_id" name="pet_id" required
                                                style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                            <option value="" selected disabled>Select Pet</option>
                                        </select>
                                        <label for="pet_id" style="color: #6267ae;">Pet*</label>
                                    </div>
                                    <!-- <button type="button" id="addPetButton" class="btn btn-outline-secondary rounded-end"
                                            style="border-color: #f6b51d; color: #6267ae;"
                                            data-bs-toggle="modal" data-bs-target="#addPetModal">
                                        <i class="mdi mdi-plus"></i>
                                    </button> -->
                                </div>
                                @error('pet_id')
                                    <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select rounded-3 select2" id="pet_code" name="pet_code"
                                            style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                        <option value="" selected disabled>Select Pet Code</option>
                                    </select>
                                    <label for="pet_code" style="color: #6267ae;">Pet Code</label>
                                    @error('pet_code')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="pet_type" 
                                           name="pet_type" value="{{ old('pet_type') }}" placeholder=" " required readonly
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="pet_type" style="color: #6267ae;">Pet Type/Breed*</label>
                                    @error('pet_type')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="pet_gender" 
                                           name="pet_gender" value="{{ old('pet_gender') }}" placeholder=" " readonly
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="pet_gender" style="color: #6267ae;">Pet Gender</label>
                                    @error('pet_gender')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control rounded-3" id="pet_dob" 
                                           name="pet_dob" value="{{ old('pet_dob') }}" placeholder=" " readonly
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="pet_dob" style="color: #6267ae;">Pet Date of Birth</label>
                                    @error('pet_dob')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pet Owner Details Section -->
                            <div class="col-12 mt-4">
                                <h5 class="fw-bold mb-3" style="color: #6267ae;">Pet Owner Details</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-3" id="pet_owner_name" 
                                           name="pet_owner_name" value="{{ old('pet_owner_name') }}" placeholder=" " readonly
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="pet_owner_name" style="color: #6267ae;">Pet Owner Name</label>
                                    @error('pet_owner_name')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control rounded-3" id="phone" 
                                           name="phone" value="{{ old('phone') }}" placeholder=" " required
                                           pattern="\+91[0-9]{10}" title="Phone number must start with +91 followed by 10 digits"
                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                    <label for="phone" style="color: #6267ae;">Phone Number* (+91)</label>
                                    @error('phone')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control rounded-3" id="notes" name="notes" 
                                              rows="4" placeholder=" " style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">{{ old('notes') }}</textarea>
                                    <label for="notes" style="color: #6267ae;">Notes</label>
                                    @error('notes')
                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tests Section -->
                            <div class="col-12 mt-4">
                                <div class="card border-0 shadow-lg rounded-4" 
                                     style="background: rgba(255,255,255,0.95); backdrop-filter: blur(14px);">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="fw-bold mb-0" style="color: #6267ae;">Select Tests</h5>
                                            <div class="input-group" style="max-width: 300px;">
                                                <input type="text" class="form-control rounded-3" id="testSearchInput" 
                                                       placeholder="Search Tests" 
                                                       style="background: rgba(255,255,255,0.95); color: #6267ae; border: 1px solid #f6b51d; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                                <button class="btn btn-outline-secondary rounded-end" type="button" id="clearSearch"
                                                        style="background: #f6b51d; color: #1f2937; border: none; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="selectedTestsCount" class="text-muted mb-3">0 tests selected</div>
                                        <div class="table-responsive">
                                            <table id="testsDataTable" class="table align-middle table-hover" style="width:100%;">
                                                <thead style="background: linear-gradient(135deg, #ac7fb6 0%, #f6b51d 100%); color: #fff;">
                                                    <tr>
                                                        <th></th>
                                                        <th>Test Name</th>
                                                        <th>Price (₹)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="checkbox" class="test-checkbox" name="tests[]" value="1" data-price="100.00"></td>
                                                        <td>Complete Blood Count</td>
                                                        <td>100.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" class="test-checkbox" name="tests[]" value="2" data-price="150.00"></td>
                                                        <td>Urinalysis</td>
                                                        <td>150.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" class="test-checkbox" name="tests[]" value="3" data-price="200.00"></td>
                                                        <td>X-Ray</td>
                                                        <td>200.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" class="test-checkbox" name="tests[]" value="4" data-price="50.00"></td>
                                                        <td>Blood Glucose Test</td>
                                                        <td>50.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" class="test-checkbox" name="tests[]" value="5" data-price="300.00"></td>
                                                        <td>Cardiac Ultrasound</td>
                                                        <td>300.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" class="test-checkbox" name="tests[]" value="6" data-price="120.00"></td>
                                                        <td>Fecal Examination</td>
                                                        <td>120.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" class="test-checkbox" name="tests[]" value="7" data-price="80.00"></td>
                                                        <td>Skin Scraping Test</td>
                                                        <td>80.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="checkbox" class="test-checkbox" name="tests[]" value="8" data-price="250.00"></td>
                                                        <td>MRI Scan</td>
                                                        <td>250.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                          {{-- Custom Pagination with Consistent Styling --}}
                                    <nav class="mt-4">
                                        <ul class="pagination justify-content-center custom-pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                                        </ul>
                                    </nav>
                                    </div>
                                </div>
                            </div>

                            <!-- Receipt Section -->
                            <div class="col-12 mt-4">
                                <div class="card border-0 shadow-lg rounded-4" 
                                     style="background: rgba(255,255,255,0.95); backdrop-filter: blur(14px);">
                                    <div class="card-body p-3">
                                        <h5 class="fw-bold mb-3" style="color: #6267ae;">Receipt</h5>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="number" step="0.01" class="form-control rounded-3" id="subtotal" 
                                                           name="subtotal" placeholder="0.00" readonly
                                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                                    <label for="subtotal" style="color: #6267ae;">Subtotal (₹)</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="number" step="0.01" min="0" class="form-control rounded-3" id="discount" 
                                                           name="discount" placeholder="0.00"
                                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                                    <label for="discount" style="color: #6267ae;">Discount (₹)</label>
                                                    @error('discount')
                                                        <span class="text-danger" style="color: #cc235e;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="number" step="0.01" class="form-control rounded-3" id="total" 
                                                           name="total" vplaceholder="0.00" readonly
                                                           style="background: #fff; color: #6267ae; border: 1px solid #f6b51d;">
                                                    <label for="total" style="color: #6267ae;">Total (₹)</label>
                                                </div>
                                            </div>
                                            <input type="hidden" id="total_amount" name="total_amount" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Form Action Buttons -->
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm px-4"
                                    style="background: #6267ae; color: #fff; border: none;" id="submitBtn">
                                <i class="mdi mdi-content-save me-2"></i> Add Appointment
                            </button>
                            <button type="reset" class="btn btn-secondary btn-lg rounded-pill shadow-sm px-4"
                                    style="background: #ac7fb6; color: #fff; border: none;">
                                <i class="mdi mdi-refresh me-2"></i> Reset
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Referee Doctor Modal -->
<div class="modal fade" id="addRefereeDoctorModal" tabindex="-1" aria-labelledby="addRefereeDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%);">
                <h5 class="modal-title text-white" id="addRefereeDoctorModalLabel">Add New Referee Doctor</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="addRefereeDoctorForm">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-3" id="doctor_name" name="name" required
                                       style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                <label for="doctor_name" style="color: #6267ae;">Name*</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="tel" class="form-control rounded-3" id="doctor_phone" name="phone" 
                                       pattern="\+91[0-9]{10}" required
                                       style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                <label for="doctor_phone" style="color: #6267ae;">Phone* (+91)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" class="form-control rounded-3" id="doctor_email" name="email"
                                       style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                <label for="doctor_email" style="color: #6267ae;">Email (Optional)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control rounded-3" id="doctor_address" name="address"
                                          style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d; height: 100px;"></textarea>
                                <label for="doctor_address" style="color: #6267ae;">Address (Optional)</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal"
                        style="background: #ac7fb6; color: #fff; border: none;">Cancel</button>
                <button type="button" class="btn btn-primary rounded-pill px-4" id="saveRefereeDoctor"
                        style="background: #6267ae; color: #fff; border: none;">
                    <span class="spinner-border spinner-border-sm d-none me-1" id="refDoctorSpinner"></span>
                    Save
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Pet Modal -->
{{-- <div class="modal fade" id="addPetModal" tabindex="-1" aria-labelledby="addPetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%);">
                <h5 class="modal-title text-white" id="addPetModalLabel">Add New Pet</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="addPetForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="pet_parent_id" id="new_pet_parent_id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-3" id="pet_name" name="name" required
                                       style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                <label for="pet_name" style="color: #6267ae;">Pet Name*</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-3" id="pet_code_input" name="code" required
                                       style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                <label for="pet_code_input" style="color: #6267ae;">Pet Code*</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select rounded-3 select2" id="pet_species" name="species" required
                                        style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                    <option value="" selected disabled>Select Species</option>
                                    <option value="Canine">Canine</option>
                                    <option value="Feline">Feline</option>
                                    <option value="Avian">Avian</option>
                                    <option value="Other">Other</option>
                                </select>
                                <label for="pet_species" style="color: #6267ae;">Species*</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-3" id="pet_breed" name="breed"
                                       style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                <label for="pet_breed" style="color: #6267ae;">Breed</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select rounded-3 select2" id="pet_gender" name="gender" required
                                        style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <label for="pet_gender" style="color: #6267ae;">Gender*</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control rounded-3" id="pet_dob" name="dob" 
                                       max="{{ date('Y-m-d') }}"
                                       style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                <label for="pet_dob" style="color: #6267ae;">Date of Birth</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" step="0.1" min="0" class="form-control rounded-3" id="pet_weight" name="weight"
                                       style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                <label for="pet_weight" style="color: #6267ae;">Weight (kg)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control rounded-3" id="pet_age" name="age"
                                       style="background: rgba(255,255,255,0.95); border: 1px solid #f6b51d;">
                                <label for="pet_age" style="color: #6267ae;">Age</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="color: #6267ae;">Pet Image</label>
                            <input type="file" class="form-control rounded-3" name="image" id="pet_image" 
                                   accept="image/*" style="border: 1px solid #f6b51d;" />
                            <p class="text-center mt-2 mb-0 text-muted">Pet Profile Image</p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal"
                        style="background: #ac7fb6; color: #fff; border: none;">Cancel</button>
                <button type="button" class="btn btn-primary rounded-pill px-4" id="savePet"
                        style="background: #6267ae; color: #fff; border: none;">
                    <span class="spinner-border spinner-border-sm d-none me-1" id="petSpinner"></span>
                    Save
                </button>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('style')

<style>
    .form-floating>.form-control, 
    .form-floating>.form-select {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #f6b51d;
        box-shadow: 0 0 8px rgba(246, 181, 29, 0.5);
    }
    .spinner-border {
        vertical-align: middle;
    }
    @media (max-width: 768px) {
        .btn-lg {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
        .form-floating label {
            font-size: 0.9rem;
        }
        .input-group#testSearchGroup {
            max-width: 100%;
        }
    }
    .input-group .form-floating {
        flex: 1;
    }
    .input-group .btn {
        z-index: 2;
        height: calc(3.5rem + 2px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 1rem;
    }
    .modal {
        z-index: 1100 !important;
    }
    .modal-backdrop {
        z-index: 1050 !important;
        backdrop-filter: blur(5px);
        background: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
        background: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    .modal-header {
        padding: 1.5rem;
        border-bottom: none;
        border-radius: 12px 12px 0 0 !important;
        background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%);
    }
    .modal-body {
        padding: 1.5rem;
    }
    .modal-footer {
        padding: 1rem;
        border-top: none;
        border-radius: 0 0 12px 12px !important;
    }
    .btn-close-white {
        filter: brightness(10);
    }
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1150;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }
    .toast-header {
        background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%);
        color: white;
        border: none;
    }
    .select2-container--default .select2-selection--single {
        border: 1px solid #f6b51d;
        border-radius: 0.375rem;
        background: #fff;
        height: calc(3.5rem + 2px) !important;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #6267ae;
        line-height: calc(3.5rem - 2px);
        padding-left: 1rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(3.5rem - 2px);
        right: 0.5rem;
    }
    .select2-container--default .select2-selection--single:focus {
        border-color: #f6b51d;
        box-shadow: 0 0 8px rgba(246, 181, 29, 0.5);
    }
    .select2-dropdown {
        border: 1px solid #f6b51d;
        border-radius: 0.375rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid #f6b51d !important;
        border-radius: 0.375rem !important;
        background: rgba(255, 255, 255, 0.95) !important;
        color: #6267ae !important;
        padding: 0.5rem !important;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
        border-color: #f6b51d !important;
        box-shadow: 0 0 8px rgba(246, 181, 29, 0.5) !important;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field::placeholder {
        color: #6267ae !important;
        opacity: 0.7 !important;
    }
    .select2-results__option {
        color: #6267ae;
    }
    .select2-results__option--highlighted {
        background: #f6b51d !important;
        color: #1f2937 !important;
    }
    .form-floating .select2-container {
        position: relative;
        z-index: 3;
    }
    .form-floating .select2-container--default .select2-selection--single .select2-selection__rendered {
        margin-top: -0.5rem;
    }
    #testsDataTable th:first-child, #testsDataTable td:first-child {
        width: 5%;
    }
    #testsDataTable th:nth-child(2), #testsDataTable td:nth-child(2) {
        width: 70%;
    }
    #testsDataTable th:nth-child(3), #testsDataTable td:nth-child(3) {
        width: 25%;
    }
    .test-checkbox {
        margin: 0;
    }
    .dataTables_paginate .pagination {
        margin-top: 1rem;
        justify-content: center;
    }
    .dataTables_paginate .pagination .page-link {
        border-radius: 50%;
        margin: 0 4px;
        padding: 8px 14px;
        color: #6267ae;
        font-weight: 600;
        border: none;
        background: rgba(255,255,255,0.95);
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .dataTables_paginate .pagination .page-link:hover {
        background: #f6b51d;
        color: #fff;
    }
    .dataTables_paginate .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #6267ae 0%, #cc235e 100%);
        color: #fff;
    }
    .dataTables_wrapper .dataTables_filter {
        display: none; /* Hide default DataTable search */
    }
    #testSearchInput:focus {
        border-color: #f6b51d;
        box-shadow: 0 0 8px rgba(246, 181, 29, 0.5);
    }
    #testSearchInput::placeholder {
        color: #6267ae;
        opacity: 0.7;
    }
    #clearSearch:hover {
        background: #cc235e;
        color: #fff;
    }
</style>
@endsection

@section('scripts')
<script src="{{ asset('assets/libs/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js') }}"></script>


<script>
$(document).ready(function (){

    // Calculate total
    function updateTotal(){
        let subtotal = 0;
        const selectedTests = $('.test-checkbox:checked');
        
        selectedTests.each(function () {
            subtotal += parseFloat($(this).data('price')) || 0;
        });

        let discount = parseFloat($('#discount').val()) || 0;

        if (discount > subtotal) {
            discount = subtotal;
            $('#discount').val(discount.toFixed(2));
            toastr.warning('Discount cannot exceed subtotal.');
        }

        let total = Math.max(0, subtotal - discount);

        $('#subtotal').val(subtotal.toFixed(2));
        $('#total_amount').val(total.toFixed(2));
        $('#total').val(total.toFixed(2));

        const selectedCount = selectedTests.length;
        $('#selectedTestsCount').text(`${selectedCount} test${selectedCount !== 1 ? 's' : ''} selected`);
    }

    $('#selectAllTests').on('change', function () {
        $('.test-checkbox').prop('checked', this.checked);
        updateTotal();
    });

    
    $(document).on('change', '.test-checkbox', function () {
        const allChecked = $('.test-checkbox:checked').length === $('.test-checkbox').length;
        $('#selectAllTests').prop('checked', allChecked);
        updateTotal();
    });

   
    $('#discount').on('input', function () {
        updateTotal();
    });


    $('#registrationForm').on('submit', function (e) {
        if ($('.test-checkbox:checked').length === 0) {
            e.preventDefault();
            toastr.error('Please select at least one test.');
            return false;
        }

        $('#submitSpinner').removeClass('d-none');
        $('#submitBtn').prop('disabled', true);
    });

    updateTotal();
});
</script>

@endsection
