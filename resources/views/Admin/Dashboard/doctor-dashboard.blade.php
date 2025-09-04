@section('meta_title')
Chromo Xpert | Doctor Dashboard
@endsection

@extends('Admin.Layouts.layout')

@section('css')
<style>
    :root {
        --primary-color: #2c3e50; /* Dark blue for headers and accents */
        --secondary-color: #3498db; /* Bright blue for buttons and highlights */
        --success-color: #27ae60; /* Green for approved status */
        --warning-color: #f1c40f; /* Yellow for pending status */
        --danger-color: #e74c3c; /* Red for rejected status */
        --background-color: #ecf0f1; /* Light background */
        --card-background: #ffffff; /* White card background */
        --text-color: #34495e; /* Dark text for readability */
        --muted-color: #7f8c8d; /* Muted text for secondary info */
    }

    body {
        background: var(--background-color);
        font-family: 'Roboto', sans-serif;
        color: var(--text-color);
        line-height: 1.6;
    }

    .content-page {
        padding: 2rem 1.5rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    h1 {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    p.subtitle {
        color: var(--muted-color);
        font-size: 1.1rem;
        margin-bottom: 2.5rem;
    }

    h4 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }

    .reports-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .report-card {
        background: var(--card-background);
        border-radius: 0.75rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 1.75rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .patient-name {
        color: var(--secondary-color);
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .report-meta {
        font-size: 0.95rem;
        color: var(--muted-color);
        margin-bottom: 1rem;
    }

    .report-meta span {
        display: block;
        margin-bottom: 0.25rem;
    }

    .report-details {
        border-top: 1px solid #e5e7eb;
        padding-top: 1rem;
        margin-bottom: 1rem;
    }

    .report-details ul {
        padding-left: 1.25rem;
        margin: 0;
        list-style-type: disc;
    }

    .report-details li {
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .status-pending {
        color: var(--warning-color);
        font-weight: 600;
    }

    .status-approved {
        color: var(--success-color);
        font-weight: 600;
    }

    .status-rejected {
        color: var(--danger-color);
        font-weight: 600;
    }

    .priority-normal {
        color: var(--success-color);
        font-weight: 600;
    }

    .priority-urgent {
        color: var(--danger-color);
        font-weight: 600;
    }

    .priority-high {
        color: #e91e63; /* Pink for high priority */
        font-weight: 600;
    }

    .action-row {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.3rem;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-view {
        color: var(--secondary-color);
        background: transparent;
        border: none;
        text-decoration: underline;
    }

    .btn-view:hover {
        color: #2980b9;
    }

    .btn-approve {
        background-color: var(--success-color);
        color: #fff;
        border: none;
    }

    .btn-approve:hover {
        background-color: #219653;
        transform: translateY(-2px);
    }

    .btn-sign {
        background-color: #f1c40f;
        color: #fff;
        border: none;
    }

    .btn-sign:hover {
        background-color: #d4ac0d;
        transform: translateY(-2px);
    }

    .btn-reject {
        background-color: var(--danger-color);
        color: #fff;
        border: none;
    }

    .btn-reject:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: var(--card-background);
        padding: 2rem;
        border-radius: 0.75rem;
        max-width: 500px;
        width: 90%;
        position: relative;
    }

    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--muted-color);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .reports-container {
            grid-template-columns: 1fr;
        }

        .report-card {
            max-width: 100%;
        }

        .btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')
<div class="content-page mt-5">
    <div class="content container-fluid">
        <h1>Welcome to Chromo Xpert, Doctor</h1>
        <p class="subtitle">Effortlessly review and manage patient lab reports with our intuitive dashboard.</p>

        <h4>Latest Lab Reports</h4>

        <div class="reports-container">
            <div class="report-card">
                <div class="patient-name.">Patient: John Doe</div>
                <div class="report-meta">
                    <span>Report ID: #A12345</span>
                    <span>Date: 2024-06-10</span>
                </div>
                <div class="report-details">
                    <ul>
                        <li>Test: Blood Test</li>
                        <li>Status: <span class="status-pending">Pending</span></li>
                        <li>Priority: <span class="priority-normal">Normal</span></li>
                    </ul>
                </div>
                <div class="action-row">
                    <button class="btn btn-view" onclick="openModal('John Doe', '#A12345')">View Report</button>
                    <button class="btn btn-approve" onclick="updateStatus('#A12345', 'approved')">Approve</button>
                    <button class="btn btn-sign" onclick="signReport('#A12345')">Sign Report</button>
                    <button class="btn btn-reject" onclick="updateStatus('#A12345', 'rejected')">Reject</button>
                </div>
            </div>

            <div class="report-card">
                <div class="patient-name">Patient: Sarah Connor</div>
                <div class="report-meta">
                    <span>Report ID: #B78901</span>
                    <span>Date: 2024-06-09</span>
                </div>
                <div class="report-details">
                    <ul>
                        <li>Test: X-Ray</li>
                        <li>Status: <span class="status-approved">Approved</span></li>
                        <li>Priority: <span class="priority-urgent">Urgent</span></li>
                    </ul>
                </div>
                <div class="action-row">
                    <button class="btn btn-view" onclick="openModal('Sarah Connor', '#B78901')">View Report</button>
                    <button class="btn btn-approve" onclick="updateStatus('#B78901', 'approved')">Approve</button>
                    <button class="btn btn-sign" onclick="signReport('#B78901')">Sign Report</button>
                    <button class="btn btn-reject" onclick="updateStatus('#B78901', 'rejected')">Reject</button>
                </div>
            </div>

            <div class="report-card">
                <div class="patient-name">Patient: Michael Smith</div>
                <div class="report-meta">
                    <span>Report ID: #C45678</span>
                    <span>Date: 2024-06-08</span>
                </div>
                <div class="report-details">
                    <ul>
                        <li>Test: Urine Test</li>
                        <li>Status: <span class="status-rejected">Rejected</span></li>
                        <li>Priority: <span class="priority-high">High</span></li>
                    </ul>
                </div>
                <div class="action-row">
                    <button class="btn btn-view" onclick="openModal('Michael Smith', '#C45678')">View Report</button>
                    <button class="btn btn-approve" onclick="updateStatus('#C45678', 'approved')">Approve</button>
                    <button class="btn btn-sign" onclick="signReport('#C45678')">Sign Report</button>
                    <button class="btn btn-reject" onclick="updateStatus('#C45678', 'rejected')">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Viewing Report -->
    <div class="modal" id="reportModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <h3>Report Details</h3>
            <p><strong>Patient:</strong> <span id="modal-patient"></span></p>
            <p><strong>Report ID:</strong> <span id="modal-report-id"></span></p>
            <p><strong>Details:</strong> Detailed report information goes here...</p>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Modal Functionality
    function openModal(patientName, reportId) {
        document.getElementById('modal-patient').textContent = patientName;
        document.getElementById('modal-report-id').textContent = reportId;
        document.getElementById('reportModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('reportModal').style.display = 'none';
    }

    // Simulate status updates (static, for demo)
    function updateStatus(reportId, status) {
        alert(`Report ${reportId} ${status} successfully!`);
    }

    // Simulate signing a report (static, for demo)
    function signReport(reportId) {
        alert(`Report ${reportId} signed successfully!`);
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('reportModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
@endsection