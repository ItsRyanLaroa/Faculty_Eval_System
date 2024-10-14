<style>
    .nav-bar {
        display: flex;
        justify-content: space-around;
        background: #f4f4f4;
        padding: 10px 0;
    }

    .nav-bar a {
        text-decoration: none;
        padding: 10px 15px;
        color: #333;
    }

    .nav-bar a.active {
        font-weight: bold;
        border-bottom: 2px solid blue;
    }

    .content-container {
        margin-top: 20px;
        padding: 20px;
    }

    .card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 300px;
        margin: 0 auto;
        text-align: center;
    }

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
    }

    .card select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .card button {
        padding: 10px 15px;
        background-color: blue;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .card button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .card button:not(:disabled):hover {
        background-color: darkblue;
    }
</style>

<div class="nav-bar">
    <a href="./index.php?page=semester" class="nav-link nav-semester <?php echo (isset($_GET['page']) && $_GET['page'] == 'semester') ? 'active' : ''; ?>">Semester</a>
    <a href="./index.php?page=category" class="nav-link nav-category <?php echo (isset($_GET['page']) && $_GET['page'] == 'category') ? 'active' : ''; ?>">Category</a>
    <a href="./index.php?page=questionnaire" class="nav-link nav-questionnaire <?php echo (isset($_GET['page']) && $_GET['page'] == 'questionnaire') ? 'active' : ''; ?>">Questionnaire</a>
</div>

<div class="center">
    <div class="card">
        <h3>Select a Semester</h3>
        <select id="semesterDropdown">
            <option value="">Select a Semester</option>
            <?php
            include 'db_connect.php';
            $qry = $conn->query("SELECT * FROM academic_list ORDER BY abs(year) DESC, abs(semester) DESC");
            while ($row = $qry->fetch_assoc()):
            ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['year'] . " - Semester " . $row['semester']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button id="nextToCategory" class="nextButton" disabled>Next</button>
    </div>
</div>

<script>
    document.getElementById("semesterDropdown").addEventListener("change", function() {
        document.getElementById("nextToCategory").disabled = !this.value;
    });

    document.getElementById("nextToCategory").addEventListener("click", function() {
        const selectedSemester = document.getElementById("semesterDropdown").value;
        if (selectedSemester) {
            window.location.href = `./index.php?page=category&semester_id=${selectedSemester}`;
        }
    });
</script>
