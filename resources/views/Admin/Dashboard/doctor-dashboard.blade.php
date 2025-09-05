@extends('Admin.Layouts.layout')

@section('meta_title')
Chromo Xpert | Doctor Dashboard
@endsection

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

    /* Search and Filter Styles */
    .search-filter-container {
        background: var(--card-background);
        border-radius: 0.75rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .search-filter-row {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .search-filter-row {
            flex-direction: row;
        }
    }

    .search-box {
        flex: 1;
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted-color);
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 1rem;
        color: var(--text-color);
        transition: border-color 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    .filter-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .filter-select {
        padding: 0.75rem 2.5rem 0.75rem 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.95rem;
        color: var(--text-color);
        background-color: white;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%237f8c8d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    /* Pagination Styles */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2.5rem;
        gap: 0.5rem;
    }

    .pagination-btn {
        padding: 0.5rem 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.3rem;
        background-color: white;
        color: var(--text-color);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .pagination-btn:hover:not(:disabled) {
        background-color: #f8f9fa;
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .pagination-pages {
        display: flex;
        gap: 0.25rem;
    }

    .page-number {
        min-width: 2.5rem;
        height: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e5e7eb;
        border-radius: 0.3rem;
        background-color: white;
        color: var(--text-color);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .page-number:hover {
        background-color: #f8f9fa;
    }

    .page-number.active {
        background-color: var(--secondary-color);
        color: white;
        border-color: var(--secondary-color);
    }

    .no-results {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem;
        background: var(--card-background);
        border-radius: 0.75rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .no-results-icon {
        font-size: 3rem;
        color: #e5e7eb;
        margin-bottom: 1rem;
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

        .filter-group {
            width: 100%;
        }

        .filter-select {
            flex: 1;
            min-width: 120px;
        }
    }
</style>
@endsection

@section('content')
<div class="content-page mt-5">
    <div class="content container-fluid">
        <h1>Welcome to Chromo Xpert, Doctor</h1>
        <p class="subtitle">Effortlessly review and manage patient lab reports with our intuitive dashboard.</p>

        <!-- Search and Filter Section -->
        <div class="search-filter-container">
            <div class="search-filter-row">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search by patient name, report ID, or test type...">
                </div>
                <div class="filter-group">
                    <select id="statusFilter" class="filter-select">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <select id="priorityFilter" class="filter-select">
                        <option value="">All Priorities</option>
                        <option value="normal">Normal</option>
                        <option value="high">High</option>
                        <option value="urgent">Urgent</option>
                    </select>
                    <select id="sortFilter" class="filter-select">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="patient">Patient Name (A-Z)</option>
                    </select>
                </div>
            </div>
        </div>

        <h4>Latest Lab Reports</h4>

        <div id="reportsContainer" class="reports-container">
            <!-- Reports will be dynamically inserted here -->
        </div>

        <!-- Pagination Controls -->
        <div class="pagination-container mb-5">
            <button id="prevPage" class="pagination-btn">
                <i class="fas fa-chevron-left"></i> Previous
            </button>
            <div id="paginationNumbers" class="pagination-pages">
                <!-- Page numbers will be dynamically inserted here -->
            </div>
            <button id="nextPage" class="pagination-btn">
                Next <i class="fas fa-chevron-right"></i>
            </button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script>
    // Sample data for demonstration
    const reportsData = [
        {
            id: 1,
            patient: "John Doe",
            reportId: "#A12345",
            date: "2024-06-10",
            test: "Blood Test",
            status: "pending",
            priority: "normal"
        },
        {
            id: 2,
            patient: "Sarah Connor",
            reportId: "#B78901",
            date: "2024-06-09",
            test: "X-Ray",
            status: "approved",
            priority: "urgent"
        },
        {
            id: 3,
            patient: "Michael Smith",
            reportId: "#C45678",
            date: "2024-06-08",
            test: "Urine Test",
            status: "rejected",
            priority: "high"
        },
        {
            id: 4,
            patient: "Emily Johnson",
            reportId: "#D98765",
            date: "2024-06-07",
            test: "MRI Scan",
            status: "pending",
            priority: "urgent"
        },
        {
            id: 5,
            patient: "Robert Brown",
            reportId: "#E65432",
            date: "2024-06-06",
            test: "CT Scan",
            status: "approved",
            priority: "normal"
        },
        {
            id: 6,
            patient: "Lisa Anderson",
            reportId: "#F32198",
            date: "2024-06-05",
            test: "Ultrasound",
            status: "pending",
            priority: "high"
        },
        {
            id: 7,
            patient: "David Wilson",
            reportId: "#G75319",
            date: "2024-06-04",
            test: "Blood Test",
            status: "approved",
            priority: "normal"
        },
        {
            id: 8,
            patient: "Maria Garcia",
            reportId: "#H15963",
            date: "2024-06-03",
            test: "ECG",
            status: "rejected",
            priority: "urgent"
        },
        {
            id: 9,
            patient: "James Taylor",
            reportId: "#I85246",
            date: "2024-06-02",
            test: "X-Ray",
            status: "pending",
            priority: "high"
        }
    ];

    // Configuration
    const itemsPerPage = 6;
    let currentPage = 1;
    let filteredReports = [...reportsData];

    // DOM Elements
    const reportsContainer = document.getElementById('reportsContainer');
    const paginationNumbers = document.getElementById('paginationNumbers');
    const prevButton = document.getElementById('prevPage');
    const nextButton = document.getElementById('nextPage');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const priorityFilter = document.getElementById('priorityFilter');
    const sortFilter = document.getElementById('sortFilter');

    // Initialize the dashboard
    document.addEventListener('DOMContentLoaded', function() {
        renderReports();
        setupPagination();
        setupEventListeners();
    });

    // Set up event listeners for search and filters
    function setupEventListeners() {
        searchInput.addEventListener('input', handleSearchAndFilter);
        statusFilter.addEventListener('change', handleSearchAndFilter);
        priorityFilter.addEventListener('change', handleSearchAndFilter);
        sortFilter.addEventListener('change', handleSearchAndFilter);
        prevButton.addEventListener('click', goToPrevPage);
        nextButton.addEventListener('click', goToNextPage);
    }

    // Handle search and filter changes
    function handleSearchAndFilter() {
        currentPage = 1; // Reset to first page when filters change
        filterReports();
        renderReports();
        setupPagination();
    }

    // Filter reports based on search and filter criteria
    function filterReports() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const priorityValue = priorityFilter.value;
        const sortValue = sortFilter.value;

        filteredReports = reportsData.filter(report => {
            const matchesSearch = 
                report.patient.toLowerCase().includes(searchTerm) ||
                report.reportId.toLowerCase().includes(searchTerm) ||
                report.test.toLowerCase().includes(searchTerm);
            
            const matchesStatus = statusValue ? report.status === statusValue : true;
            const matchesPriority = priorityValue ? report.priority === priorityValue : true;
            
            return matchesSearch && matchesStatus && matchesPriority;
        });

        // Sort the filtered reports
        switch(sortValue) {
            case 'newest':
                filteredReports.sort((a, b) => new Date(b.date) - new Date(a.date));
                break;
            case 'oldest':
                filteredReports.sort((a, b) => new Date(a.date) - new Date(b.date));
                break;
            case 'patient':
                filteredReports.sort((a, b) => a.patient.localeCompare(b.patient));
                break;
        }
    }

    // Render reports for the current page
    function renderReports() {
        reportsContainer.innerHTML = '';
        
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const paginatedReports = filteredReports.slice(startIndex, endIndex);
        
        if (paginatedReports.length === 0) {
            reportsContainer.innerHTML = `
                <div class="no-results">
                    <div class="no-results-icon">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>
                    <p>No reports found matching your criteria.</p>
                </div>
            `;
            return;
        }
        
        paginatedReports.forEach(report => {
            const statusClass = `status-${report.status}`;
            const priorityClass = `priority-${report.priority}`;
            
            const reportElement = document.createElement('div');
            reportElement.className = 'report-card';
            reportElement.innerHTML = `
                <div class="patient-name">Patient: ${report.patient}</div>
                <div class="report-meta">
                    <span>Report ID: ${report.reportId}</span>
                    <span>Date: ${report.date}</span>
                </div>
                <div class="report-details">
                    <ul>
                        <li>Test: ${report.test}</li>
                        <li>Status: <span class="${statusClass}">${report.status.charAt(0).toUpperCase() + report.status.slice(1)}</span></li>
                        <li>Priority: <span class="${priorityClass}">${report.priority.charAt(0).toUpperCase() + report.priority.slice(1)}</span></li>
                    </ul>
                </div>
                <div class="action-row mb-1">
                    <button class="btn btn-view" onclick="openModal('${report.patient}', '${report.reportId}')">View Report</button>
                </div>
                <div class="action-row">
                    <button class="btn btn-approve" onclick="updateStatus('${report.reportId}', 'approved')">Approve</button>
                    <button class="btn btn-sign" onclick="signReport('${report.reportId}')">Sign Report</button>
                    <button class="btn btn-reject" onclick="updateStatus('${report.reportId}', 'rejected')">Reject</button>
                </div>
            `;
            
            reportsContainer.appendChild(reportElement);
        });
    }

    // Set up pagination controls
    function setupPagination() {
        paginationNumbers.innerHTML = '';
        const pageCount = Math.ceil(filteredReports.length / itemsPerPage);
        
        if (pageCount <= 1) {
            prevButton.disabled = true;
            nextButton.disabled = true;
            return;
        }
        
        // Show previous button state
        prevButton.disabled = currentPage === 1;
        
        // Show next button state
        nextButton.disabled = currentPage === pageCount;
        
        // Determine which page numbers to show
        let startPage = Math.max(1, currentPage - 1);
        let endPage = Math.min(pageCount, startPage + 2);
        
        if (endPage - startPage < 2) {
            startPage = Math.max(1, endPage - 2);
        }
        
        // Create page number buttons
        for (let i = startPage; i <= endPage; i++) {
            const pageButton = document.createElement('button');
            pageButton.className = `page-number ${i === currentPage ? 'active' : ''}`;
            pageButton.textContent = i;
            pageButton.addEventListener('click', () => {
                currentPage = i;
                renderReports();
                setupPagination();
            });
            
            paginationNumbers.appendChild(pageButton);
        }
    }

    // Navigate to previous page
    function goToPrevPage() {
        if (currentPage > 1) {
            currentPage--;
            renderReports();
            setupPagination();
        }
    }

    // Navigate to next page
    function goToNextPage() {
        const pageCount = Math.ceil(filteredReports.length / itemsPerPage);
        if (currentPage < pageCount) {
            currentPage++;
            renderReports();
            setupPagination();
        }
    }

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