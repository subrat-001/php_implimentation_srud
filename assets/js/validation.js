// Add your input validation JavaScript here
document.addEventListener("DOMContentLoaded", function () {
    const salaryInput = document.getElementById("salary");
    const salaryError = document.getElementById("salary-error");

    salaryInput.addEventListener("input", function () {
        const salary = parseInt(this.value);

        if (salary < 10000 || salary > 50000) {
            salaryError.textContent = "Salary must be between 10000 and 50000";
        } else {
            salaryError.textContent = "";
        }
    });
});
