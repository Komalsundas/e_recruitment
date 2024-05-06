
$(function() {
    var years = $(".completion_year");
    var currentYear = (new Date()).getFullYear();
    for (var i = currentYear; i >= 2000; i--) {
        var option = $("<option />");
        option.html(i);
        option.val(i);
        years.append(option);
    }
});



                                        function showField(radio_val) {
                                            clearField();
                                            if (radio_val == "C") {
                                                $('#com_div').show();
                                                $('#eco_div').show();
                                                $('#acc_div').show();

                                                $('#phy_div').hide();
                                                $('#che_div').hide();
                                                $('#bio_div').hide();
                                                $('#geo_div').hide();
                                                $('#his_div').hide();
                                                $('#media_div').hide();
                                                $('#rigzhung_div').hide();

                                            } else if (radio_val == "A") {
                                                $('#com_div').hide();
                                                $('#eco_div').show();
                                                $('#acc_div').hide();
                                                $('#phy_div').hide();
                                                $('#che_div').hide();
                                                $('#bio_div').hide();

                                                $('#geo_div').show();
                                                $('#his_div').show();
                                                $('#media_div').show();
                                                $('#rigzhung_div').show();


                                            } else {
                                                $('#com_div').hide();
                                                $('#eco_div').hide();
                                                $('#acc_div').hide();
                                                $('#geo_div').hide();
                                                $('#his_div').hide();
                                                $('#media_div').hide();
                                                $('#rigzhung_div').hide();


                                                $('#phy_div').show();
                                                $('#che_div').show();
                                                $('#bio_div').show();
                                            }

                                            function clearField() {
                                                $('#xii_eng').val('');
                                                $('#xii_dzo').val('');
                                                $('#xii_mat').val('');
                                                $('#xii_phy').val('');
                                                $('#xii_che').val('');
                                                $('#xii_bio').val('');
                                                $('#xii_it').val('');
                                                $('#xii_com').val('');
                                                $('#xii_eco').val('');
                                                $('#xii_acc').val('');
                                                $('#xii_geo').val('');
                                                $('#xii_his').val('');
                                                $('#xii_media').val('');
                                                $('#xii_rigzhung').val('');
                                                $('#xii_percent').val('');
                                            }
                                        }




                               
                                        // Function to check file size
                                        function checkFileSize(inputId) {
                                            var fileInput = document.getElementById(inputId);
                                            if (fileInput.files.length > 0) {
                                                var fileSize = fileInput.files[0].size; // Size in bytes
                                                var maxSize = 1024 * 1024; // 1MB in bytes
                                                if (fileSize > maxSize) {
                                                    alert('File size should not exceed 1MB.');
                                                    fileInput.value = ''; // Clear the file input
                                                    return false; // Prevent form submission
                                                }
                                            }
                                            return true; // Proceed with form submission
                                        }
                    
                                        // Event listener for form submission
                                        document.getElementById('yourFormId').addEventListener('submit', function(event) {
                                            // Check file sizes before form submission
                                            var coverLetterValid = checkFileSize('coverLetter');
                                            var cidAttachmentValid = checkFileSize('cidAttachment');
                                            var cvAttachmentValid = checkFileSize('cvAttachment');
                                            var medicalCertificateValid = checkFileSize('medicalCertificate');
                                            var nocValid = checkFileSize('noc');
                                            var x_marksheetValid = checkFileSize('x_marksheet');
                                            var xii_marksheetValid = checkFileSize('xii_marksheet');
                                            var degree_marksheetValid = checkFileSize('degree_marksheet');
                    
                                            // If any file size exceeds the limit, prevent form submission
                                            if (!coverLetterValid || !cidAttachmentValid || !cvAttachmentValid || !medicalCertificateValid || !
                                                nocValid || !x_marksheetValid || !xii_marksheetValid || !degree_marksheetValid) {
                                                event.preventDefault();
                                            }
                                        });


    
                                        
                                        // Function to save checkbox state in localStorage
                                        function saveCheckboxState(checkboxId) {
                                            const checkbox = document.getElementById(checkboxId);
                                            localStorage.setItem(checkboxId, checkbox.checked);
                                        }
            
                                        // Function to load checkbox state from localStorage
                                        function loadCheckboxState(checkboxId) {
                                            const checkbox = document.getElementById(checkboxId);
                                            const savedState = localStorage.getItem(checkboxId);
            
                                            if (savedState === 'true') {
                                                checkbox.checked = true;
                                            } else {
                                                checkbox.checked = false;
                                            }
                                        }
            
                                        // Load checkbox states on page load
                                        loadCheckboxState('flexCheckDefault');
                                        loadCheckboxState('flexCheckChecked');



                   
                            function showPreviewModal() {
                                // Get form values using form ID
                                var formValues = $('#job-form').serializeArray();

                                // Filter out unwanted fields (e.g., token and vacancy_id)
                                formValues = formValues.filter(function(field) {
                                    return field.name !== '_token' && field.name !== 'vacancy_id';
                                });

                                // Generate HTML content for preview
                                var previewContent = '<ul>';
                                $.each(formValues, function(index, field) {
                                    previewContent += '<li><strong>' + field.name + ':</strong> ' + field.value + '</li>';
                                });
                                previewContent += '</ul>';

                                // Include document files
                                var fileInputs = $('#job-form :file');
                                fileInputs.each(function() {
                                    var file = this.files[0];
                                    if (file) {
                                        // Display file name and add a link to view/download the file
                                        previewContent += '<p><strong>' + $(this).attr('name') + ':</strong> <a href="' + URL
                                            .createObjectURL(file) + '" target="_blank">' + file.name + '</a></p>';
                                    }
                                });

                                // Set the preview content in the modal
                                $('#previewFormContent').html(previewContent);

                                // Show the modal
                                $('#previewModal').modal('show');
                            }


                            
                            $(document).ready(function() {
                                $("#openModalBtn").click(function() {
                                    $("#disclaimerModal").modal("show");
                                });
                            });
                    

                    
                            $("#agreeCheckbox").change(function() {
                                if ($(this).is(":checked")) {
                                    $("#submitForm").removeClass("d-none");
                                } else {
                                    $("#submitForm").addClass("d-none");
                                }
                            });
                    

                            
                            $(function() {
                                // Update date picker for new rows
                                $(".datepicker").datepicker({
                                    dateFormat: 'yy-mm-dd',
                                    changeMonth: true,
                                    changeYear: true
                                });
                    
                                $("#insertRowExp").on("click", function(event) {
                                    event.preventDefault();
                    
                                    var newRow = $("<tr>");
                                    var cols = '';
                                    cols +=
                                        '<td><input class="form-control rounded-4" type="text" name="company[]" placeholder="Company"></td>';
                                    cols +=
                                        '<td><input class="form-control rounded-4" type="text" name="position[]" placeholder="Position"></td>';
                                    cols +=
                                        '<td><input class="form-control rounded-4 datepicker" type="text" name="from[]" placeholder="From"></td>';
                                    cols +=
                                        '<td><input class="form-control rounded-4 datepicker" type="text" name="to[]" placeholder="To"></td>';
                                    cols +=
                                        '<td><input class="form-control rounded-4" type="text" name="place[]" placeholder="Place"></td>';
                                    // cols +=
                                    //     '<td><input class="form-control rounded-4" type="text" name="reason[]" placeholder="Reason to Change"></td>';
                                    cols += '<td><input type="file" class="form-control-file" name="document[]"></td>';
                                    cols +=
                                        '<td><button class="btn btn-danger btn-sm del-Exp"><i class="fas fa-trash"></i></button</td>';
                                    newRow.append(cols);
                                    $("#experienceTable").append(newRow);
                    
                                    // Update date picker for new rows
                                    $(".datepicker").datepicker({
                                        dateFormat: 'yy-mm-dd',
                                        changeMonth: true,
                                        changeYear: true
                                    });
                                });
                                // Remove row when delete btn is clicked
                                $("table").on("click", ".del-Exp", function(event) {
                                    $(this).closest("tr").remove();
                                });
                            });



                           
                            $(function() {
                                // Update date picker for new rows
                                $(".datepicker").datepicker({
                                    dateFormat: 'yy-mm-dd',
                                    changeMonth: true,
                                    changeYear: true
                                });
                                $("#addTraining").on("click", function(event) {
                                    event.preventDefault();
                    
                                    var newRow = $("<tr>");
                                    var cols = '';
                                    cols +=
                                        '<td><input class="form-control rounded-4" type="text" name="training[]" placeholder="Training"></td>';
                                    cols +=
                                        '<td><input class="form-control rounded-4" type="text" name="country[]" placeholder="Country"></td>';
                                    cols +=
                                        '<td><input class="form-control rounded-4 datepicker" type="text" name="sdate[]" placeholder="start date"></td>'; // Change "period" to "from_period"
                                    cols +=
                                        '<td><input class="form-control rounded-4 datepicker" type="text" name="edate[]" placeholder="end date"></td>'; // Add "to_period" field
                                    cols += '<td><input type="file" class="form-control-file" name="certificates[]"></td>';
                                    cols +=
                                        '<td><button class="btn btn-danger btn-sm del-training"><i class="fas fa-trash"></i></button</td>';
                                    // Insert the columns inside a row
                                    newRow.append(cols);
                                    $("#trainingTable").append(newRow);
                    
                                    // Update date picker for new rows
                                    $(".datepicker").datepicker({
                                        dateFormat: 'yy-mm-dd',
                                        changeMonth: true,
                                        changeYear: true
                                    });
                    
                    
                                });
                    
                                // Remove row when delete btn is clicked
                                $("table").on("click", ".del-training", function(event) {
                                    $(this).closest("tr").remove();
                                });
                            });
                      
                            $(document).ready(function() {
                                // to check science radio by default
                                $("#scienceRadio").prop("checked", true);
                                var stream_val = $('input[name="stream"]:checked').val();
                                if (stream_val == "S") {
                                    $('#com_div').hide();
                                    $('#eco_div').hide();
                                    $('#acc_div').hide();
                                    $('#geo_div').hide();
                                    $('#his_div').hide();
                                    $('#media_div').hide();
                                    $('#rigzhung_div').hide();
                                }
                    
                                $("#dob").datepicker({
                                    dateFormat: "dd/mm/yy", // Set the desired date format
                                    changeMonth: true,
                                    changeYear: true,
                                });
                            });
                    
                            $(document).ready(function() {
                                // Function to check if the CID already exists
                                function checkcid() {
                                    var cid = $('#cid').val();
                                    $.ajax({
                                        url: '{{ route('checkcid') }}', // Replace with your route to check CID
                                        method: 'POST',
                                        data: {
                                            '_token': '{{ csrf_token() }}',
                                            'cid': cid
                                        },
                                        success: function(response) {
                                            if (response.exists) {
                                                $('#cidHelpBlock').text('CID already exists').show();
                                                $('#proceedButton').prop('disabled', true);
                                            } else {
                                                $('#cidHelpBlock').hide();
                                                $('#proceedButton').prop('disabled', false);
                                            }
                                        }
                                    });
                                }
                    
                                // Attach onchange event listener to the CID input field
                                $('#cid').on('change', function() {
                                    checkcid();
                                });
                    
                                // Proceed button click event
                                $('#proceedButton').click(function() {
                                    if ($('#job-form').valid()) {
                                        // Check CID before proceeding
                                        checkcid();
                                        // If CID is valid, proceed to the next tab
                                        if (!$('#cidHelpBlock').is(':visible')) {
                                            $('#education-tab').tab('show');
                                        } else {
                                            // Show a message indicating CID already exists
                                            alert('CID already exists');
                                        }
                                    }
                                });
                            });
                    
                            $('#backToEducation').click(function() {
                                if ($('#job-form').valid()) {
                                    $('#education-tab').tab('show');
                                }
                            });
                    
                            $('#nextToEmployement').click(function() {
                                if ($('#job-form').valid()) {
                                    $('#employement-tab').tab('show');
                                }
                            });
                    
                            $('#nextToTraining').click(function() {
                                if ($('#job-form').valid()) {
                                    $('#training-tab').tab('show');
                                }
                            });
                    
                            $('#backToEmployement').click(function() {
                                if ($('#job-form').valid()) {
                                    $('#employement-tab').tab('show');
                                }
                            });
                    
                            $('#backToApplicantInfo').click(function() {
                                if ($('#job-form').valid()) {
                                    $('#home-tab').tab('show');
                                }
                            });
                      
                            // Add this script after your existing JavaScript code
                    
                            // Function to validate minimum qualification criteria and display message


                            function validateQualificationCriteria() {
                                try {
                                    var xPercentage = parseFloat($('#percent').val()) || 0;
                                    var xiiPercentage = parseFloat($('#xii_percent').val()) || 0;
                                    var degreePercentage = parseFloat($('#degree_percent').val()) || 0;
                                    var $minQualification = {{ $minQualification }};
                                    var message = '';
                    
                                    // Check minimum qualification criteria
                                    if ($minQualification == 6 && xPercentage < 60) {
                                        message += "You did not meet the minimum Class 10 marks requirement.\n";
                                    } else if ($minQualification == 5 && (xPercentage < 60 || xiiPercentage < 65)) {
                                        message += "You did not meet the minimum Class 10 or Class 12 marks requirement.\n";
                                    } else if ($minQualification >= 1 && (xPercentage < 60 || xiiPercentage < 65 || degreePercentage < 70)) {
                                        message += "You did not meet the minimum qualification criteria.\n";
                                    }
                    
                                    // Display message if criteria not met
                                    if (message !== '') {
                                        alert(message);
                                    }
                                } catch (error) {
                                    console.error("Error in validateQualificationCriteria:", error);
                                }
                            }
                    
                            // Call the validation function on form submission
                            $('#submitButton').on('click', function() {
                                calculateFinalPercentage(); // Calculate final percentage
                                validateQualificationCriteria(); // Validate qualification criteria
                            });
                     
                     
                            $(document).ready(function() {
                                // Listen for changes in the input fields
                                $('.xmark').on('input', function() {
                                    // Get the marks for English and all subjects
                                    var eng = parseFloat($('#eng').val()) || 0;
                                    var dzo = parseFloat($('#dzo').val()) || 0;
                                    var mat = parseFloat($('#mat').val()) || 0;
                                    var phy = parseFloat($('#phy').val()) || 0;
                                    var che = parseFloat($('#che').val()) || 0;
                                    var bio = parseFloat($('#bio').val()) || 0;
                                    var eco = parseFloat($('#eco').val()) || 0;
                                    var his = parseFloat($('#his').val()) || 0;
                                    var geo = parseFloat($('#geo').val()) || 0;
                                    var it = parseFloat($('#it').val()) || 0;
                                    var ent = parseFloat($('#ent').val()) || 0;
                                    var agfs = parseFloat($('#agfs').val()) || 0;
                    
                    
                                    // Sort the subject marks in descending order
                                    var subjects = [dzo, mat, phy, che, bio, eco, his, geo, it, ent, agfs];
                                    subjects.sort(function(a, b) {
                                        return b - a;
                                    });
                    
                                    // Calculate the total of the best four subjects
                                    var total = eng + subjects.slice(0, 4).reduce(function(a, b) {
                                        return a + b;
                                    }, 0);
                    
                                    // Calculate the percentage
                                    var percentage = (total / 500) * 100; // Assuming total marks for all subjects are 500
                    
                                    // Set the calculated percentage in the 'percent' input field
                                    $('#percent').val(percentage.toFixed(2)); // Rounded to two decimal places
                                });
                            });
                       
                            $(document).ready(function() {
                                // Listen for changes in the input fields
                                $('.marks').on('input', function() {
                                    // Get the marks for English and all subjects
                                    var eng = parseFloat($('#xii_eng').val()) || 0;
                                    var dzo = parseFloat($('#xii_dzo').val()) || 0;
                                    var mat = parseFloat($('#xii_mat').val()) || 0;
                                    var phy = parseFloat($('#xii_phy').val()) || 0;
                                    var che = parseFloat($('#xii_che').val()) || 0;
                                    var bio = parseFloat($('#xii_bio').val()) || 0;
                                    var it = parseFloat($('#xii_it').val()) || 0;
                                    var geo = parseFloat($('#xii_geo').val()) || 0;
                                    var his = parseFloat($('#xii_his').val()) || 0;
                                    var com = parseFloat($('#xii_com').val()) || 0;
                                    var acc = parseFloat($('#xii_acc').val()) || 0;
                                    var eco = parseFloat($('#xii_eco').val()) || 0;
                                    var media = parseFloat($('#xii_media').val()) || 0;
                                    var rigzhung = parseFloat($('#xii_rigzhung').val()) || 0;
                    
                                    var stream_val = $('input[name="stream"]:checked').val();
                                    if (stream_val == 'S') {
                                        // Sort the subject marks in descending order
                                        var subjects = [dzo, mat, phy, che, bio, it];
                                    } else if (stream_val == 'C') {
                                        var subjects = [dzo, mat, com, eco, acc, it];
                                    } else {
                                        var subjects = [dzo, mat, geo, his, eco, it, media, rigzhung];
                                    }
                    
                                    subjects.sort(function(a, b) {
                                        return b - a;
                                    });
                    
                                    // Calculate the total of the best four subjects
                                    var total = eng + subjects.slice(0, 3).reduce(function(a, b) {
                                        return a + b;
                                    }, 0);
                    
                                    // Calculate the percentage
                                    var percentage = (total / 400) * 100; // Assuming total marks for all subjects are 500
                    
                                    // Set the calculated percentage in the 'scipercent' input field
                                    $('#xii_percent').val(percentage.toFixed(2)); // Rounded to two decimal places
                                });
                            });
                      
                      
                            // Function to check if all required fields in the Applicant Information tab are filled
                            function areFieldsFilled() {
                                var fields = document.querySelectorAll('#home [required]');
                                for (var i = 0; i < fields.length; i++) {
                                    if (fields[i].value.trim() === '') {
                                        return false;
                                    }
                                }
                                return true;
                            }
                    
                            // Function to enable or disable the tabs based on whether the fields are filled
                            function toggleTabs() {
                                var tabs = document.querySelectorAll('.nav-link[data-bs-toggle="tab"]');
                                tabs.forEach(function(tab) {
                                    var tabId = tab.getAttribute('aria-controls');
                                    if (tabId === 'home') return; // Skip the Applicant Information tab
                                    if (areFieldsFilled()) {
                                        tab.removeAttribute('disabled');
                                    } else {
                                        tab.setAttribute('disabled', 'disabled');
                                    }
                                });
                            }
                    
                            // Add event listener for changes in the Applicant Information tab
                            var homeTab = document.querySelector('#home-tab');
                            homeTab.addEventListener('click', function() {
                                // Toggle the other tabs when the Applicant Information tab is clicked
                                toggleTabs();
                            });
                    
                            // Initialize tab status
                            toggleTabs();
                     


                            document.getElementById('cid').addEventListener('input', function() {
                                var cidInput = this.value;
                                var cidHelpBlock = document.getElementById('cidHelpBlock');
                    
                                if (cidInput.length < 11) {
                                    cidHelpBlock.style.display = 'block';
                                } else {
                                    cidHelpBlock.style.display = 'none';
                                }
                            });
                      
                        
                        



                                                                     



                                   
                                                           
                            

