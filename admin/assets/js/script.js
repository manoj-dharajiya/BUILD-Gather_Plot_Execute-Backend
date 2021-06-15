var business_logo = "";
(function ($) {
    var claim_company_btn_html = $(".claim-company-btn").html();
    var business_verification_wrapper = $(
        "#business_verification_wrapper"
    ).html();

    if ($(".business_certificates_id").length) {
        var business_certificates_id_html = $(
            ".business_certificates_id"
        ).html();
        var business_certificates_attachment_html = $(
            ".business_certificates_attachment"
        ).html();

        if (!$(".business_certificates_id").hasClass("show")) {
            $(".business_certificates_id").html("");
        }

        $(".affidavit_example_file").hide();
    }

    var removeNotes = [];
    var removeCertificates = [];

    var themefunction = {
        addOwner: function () {
            if ($(".add-owner").length) {
                $(".add-owner").off();

                $(".add-owner").on("click", function (e) {
                    const ownerFields = `<div class="owner card">
                    <div class="card-inside">
                        <div class="row align-items-center">
                        <div class="col-md-10 col-10">
        
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Owner First Name <span class="required-field">*</span></label>
                                        <input name="owner_first_name[]" type="text" class="form-control form-control-user owner_name required" placeholder="Owner First Name">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Owner Last Name <span class="required-field">*</span></label>
                                        <input name="owner_last_name[]" type="text" class="form-control form-control-user owner_name required" placeholder="Owner Last Name">
                                    </div>
                                </div>
                            
                            </div>
        
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                    <label>Owner Email <span class="required-field">*</span></label>
                                    <input name="owner_email[]" type="email" class="form-control form-control-user owner_email required" placeholder="Owner Email">
                                    </div>
                                </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                <label>Owner Phone <span class="required-field">*</span></label>
                                <input name="owner_phone[]" type="text" class="form-control form-control-user phone-number-change owner_phone required" placeholder="(XXX) XXX-XXXX">
                                </div>
                            </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Race <span class="required-field">*</span></label>
                                        <select name="owner_race[]" class="form-control required form-control-user custom-select">
                                            <option value="">Race</option>
                                            <option value="Black">Black</option>
                                            <option value="Other">Other</option>
                                        </select>							  
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Ownership Percentage <span class="required-field">*</span></label>
                                        <input name="percentage[]" type="text" class="form-control form-control-user required" placeholder="Ownership Percentage">
                                    </div>
                                </div>                      
                            </div>
                            
                        </div>
                        <div class="col-md-2 col-2 text-center">
                            <div class="action-btns">						  
                            <span class="action-btn add-owner btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span>
                            <span class="action-btn remove-owner btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                            </div>
                        </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-12 col-12">
                                <div class="action-btns">
                                    <span class="fill-poc-value btn btn-success ">Set as POC</span> <br/> <br/>
                                </div>
                            </div>
                        </div>
                    </div>
				  </div>`;
                    $("#owners-details-wrapper").append(ownerFields);

                    themefunction.addOwner();
                    themefunction.removeOwner();
                    themefunction.fillPocContent();
                    themefunction.formatePhone();

                    return false;
                });
            }
        },
        removeOwner: function () {
            $(".remove-owner").on("click", function () {
                $(this).parent().parent().parent().parent().parent().remove();
            });
        },
        fillPocContent: function () {
            $(".fill-poc-value").on("click", function () {
                var parentDiv = $(this).parent().parent().parent().parent();
                var fname = parentDiv.find(".owner_first_name").val(),
                    lname = parentDiv.find(".owner_last_name").val(),
                    email = parentDiv.find(".owner_email").val(),
                    phone = parentDiv.find(".owner_phone").val();

                // console.log(name, email, phone);

                $("#primary_poc_first_name").val(fname);
                $("#primary_poc_last_name").val(lname);
                $("#primary_poc_email").val(email);
                $("#primary_poc_phone").val(phone);
            });
        },
        addCertificate: function () {
            if ($(".add-certificate").length) {
                $(".add-certificate").off();
                $(".add-certificate").on("click", function (e) {
                    var certificateWrapper = $(this)
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent();
                    // const ownerFields = $(
                    // 	"#business-certificate-wrapper .owner:first-child"
                    // )[0].outerHTML;
                    const ownerFields = `<div class="card owner">
                        <div class="card-inside">
                            <div class="row align-items-center">              
                                <div class="col-md-10 col-sm-10 col-10">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Business Certificate</label>
                                                <select name="business_certificates[]" class="form-control form-control-user business_certificates custom-select">
                                                    <option value="">Select Business Certificate</option>
                                                    <option value="Women Owned">Women Owned</option>
                                                    <option value="Veteran Owned">Veteran Owned</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Business Certificates ID</label>
                                                <input type="text" name="business_certificates_id[]" class="form-control form-control-user" placeholder="Business Certificate ID" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Business Attachment <span class="required-field">*</span></label>
                                                <input type="file" name="business_certificates_file[]" class="form-control form-control-user required">
                                            </div>
                                        </div>
                                    </div>                  
                                </div>
                                <div class="col-md-2 col-sm-2 col-2 text-center">
                                    <div class="action-btns">
                                        <span class="action-btn add-certificate btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span>
                                        <span class="action-btn remove-certificate btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>`;

                    certificateWrapper.append(ownerFields);

                    themefunction.addCertificate();
                    themefunction.removeCertificate();
                    themefunction.changeCertificate();
                });
            }
        },
        removeCertificate: function () {
            $(".remove-certificate").on("click", function (e) {
                var certificateid = $(this).data("certificateid");
                if (certificateid) {
                    removeCertificates.push(certificateid);
                    $("#remove_business_certificates").val(removeCertificates);
                }
                $(this).parent().parent().parent().parent().parent().remove();
            });
        },
        changeCertificate: function () {
            $(".business_certificates").off();
            $(".business_certificates").on("change", function () {
                var value = $(this).val();
                const parentDiv = $(this).parent().parent().parent().parent();

                // if (value === "other") {
                //     var otherOptions = `<div class="col-md-12 col-sm-12 col-xs-12">
                // 		<div class="form-group">
                // 			<label>Business Attachment <span class="required-field">*</span></label>
                // 			<input type="file" name="business_certificates_file[]" class="form-control form-control-user required">
                // 		</div>
                // 	</div>`;

                //     parentDiv.find(".other-option").append(otherOptions);
                //     parentDiv.find(".other-option").css({ display: "flex" });
                // } else {
                //     console.log("remove Options");
                //     parentDiv.find(".other-option").html("");
                // }
            });
        },

        addSocialMedia: function () {
            if ($(".add-social-media").length) {
                $(".add-social-media").off();
                $(".add-social-media").on("click", function (e) {
                    // const ownerFields = $("#social-wrapper .owner:first-child")[0].outerHTML;
                    const ownerFields = `<div class="card owner">
                    <div class="card-inside">
                        <div class="row align-items-center">              
                            <div class="col-md-10 col-sm-10 col-10">
                                <div class="row align-items-center">
            
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Social Medial </label>
                                            <select name="social_media[]" class="form-control form-control-user custom-select">
                                            <option value="">Social Medial</option>
                                            <option value="facebook">Facebook</option>
                                            <option value="instagram">Instagram</option>
                                            <option value="twitter">Twitter</option>
                                            <option value="linkedin">LinkedIn</option>
                                            <option value="youtube">Youtube</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label>Social Link </label>
                                            <input type="text" name="social_link[]" class="form-control form-control-user" placeholder="Link">                      
                                        </div>
                                    </div>
            
                                </div>
                                
                            </div>
                            <div class="col-md-2 col-sm-2 col-2 text-center">
                                <div class="action-btns">
                                    <span class="action-btn add-social-media btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span>
                                    <span class="action-btn remove-social-media btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
					</div>
				  </div>`;
                    $("#social-wrapper").append(ownerFields);

                    themefunction.addSocialMedia();
                    themefunction.removeSocialMedia();
                });
            }
        },
        removeSocialMedia: function () {
            $(".remove-social-media").on("click", function (e) {
                $(this).parent().parent().parent().parent().parent().remove();
            });
        },
        addAdminNotes: function () {
            $(".add-note").off();
            $(".add-note").on("click", function (e) {
                // const ownerFields = $("#admin-notes-wrapper .owner:first-child")[0].outerHTML;
                const ownerFields = `<div class="card owner">                                    
					<div class="row align-items-center">              
						<div class="col-md-10 col-sm-10 col-10">
                            <div class="form-group">
                                <label>Note</label>
								<textarea name="admin_notes[]" class="form-control form-control-user admin-notes"></textarea>                                      
							</div>
                            <div class="form-group">	
                                <label>Note Attachment</label>							
								<input type="file" name="notes_attachment[]" class="form-control form-control-user">									
							</div>
						</div>
						<div class="col-md-2 col-sm-2 col-2 text-center">
							<div class="action-btns">
								<!-- <span class="action-btn add-note btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span> -->
								<span class="action-btn remove-note btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
							</div>
						</div>
					</div>								
				</div>`;

                $("#admin-notes-wrapper").append(ownerFields);

                themefunction.addAdminNotes();
                themefunction.removeAdminNotes();
            });
        },
        removeAdminNotes: function () {
            $(".remove-note").on("click", function (e) {
                var noteid = $(this).data("noteid");
                if (noteid) {
                    removeNotes.push(noteid);
                    $("#remove_notes").val(removeNotes);
                }
                $(this).parent().parent().parent().parent().remove();
            });
        },
        formatePhone: function () {
            $(".phone-number-change").off();

            $(".phone-number-change").bind("keydown", function (event) {
                // console.log("test");
                // Allow: backspace, delete
                if (event.keyCode == 46 || event.keyCode == 8) {
                    var tempField = $(this).attr("name");
                    var hiddenID = tempField.substr(tempField.indexOf("_") + 1);
                    $("#" + hiddenID).val("");
                    $(this).val("");
                    return;
                } // Allow: tab, escape, and enter
                else if (
                    event.keyCode == 9 ||
                    event.keyCode == 27 ||
                    event.keyCode == 13 ||
                    // Allow: Ctrl+A
                    (event.keyCode == 65 && event.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (event.keyCode >= 35 && event.keyCode <= 39)
                ) {
                    // let it happen, don't do anything
                    return;
                } else {
                    var phoneLength = event.target.value.length;
                    // Ensure that it is a number and stop the keypress
                    if (
                        event.shiftKey ||
                        ((event.keyCode < 48 || event.keyCode > 57) &&
                            (event.keyCode < 96 || event.keyCode > 105)) ||
                        phoneLength === 10
                    ) {
                        event.preventDefault();
                    }
                }
            });

            $(".phone-number-change").on("blur", function () {
                var oldPhone = $(this).val();
                if (oldPhone.length === 10) {
                    var newphone = formatPhoneNumber(oldPhone);
                    console.log(oldPhone, newphone);
                    $(this).val(newphone);
                }
            });
        },
        claim_business_request: function () {
            $(".add-note").off();
            $("#claim_business_request").on("click", function () {
                var id = $(this).data("businessid");
                var tempBus = business[id];

                owner_name = tempBus.business_owners[0]["owner_name"];
                owner_email = tempBus.business_owners[0]["owner_email"];
                owner_phone = tempBus.business_owners[0]["owner_phone"];

                $("#request_first_name").val(owner_name);
                $("#request_last_name").val("");
                $("#request_email").val(owner_email);
                $("#request_phone").val(owner_phone);

                $("#claim_business_id").val(id);

                $("#claim_business_request_modal .company_name").text(
                    tempBus.business_name
                );

                $("#details-popup").modal("hide");
                $("#claim_business_request_modal").modal("show");
                setTimeout(function () {
                    $("body").addClass("modal-open");
                }, 500);

                return false;
            });
        },
        business_verification: function () {
            $(".business_certificates").off();

            $(".business_certificates").on("change", function () {
                var business_certificates_wrapper = $(this)
                    .parent()
                    .parent()
                    .parent();
                var curent_val = $(this).val();

                if (
                    (curent_val === "MD MBE" || curent_val === "Other MBE") &&
                    curent_val !== ""
                ) {
                    business_certificates_wrapper
                        .find(".business_certificates_id")
                        .html(business_certificates_id_html);
                    business_certificates_wrapper
                        .find(".affidavit_example_file")
                        .hide();
                } else if (curent_val == "Affidavit") {
                    business_certificates_wrapper
                        .find(".business_certificates_id")
                        .html("");

                    business_certificates_wrapper
                        .find(".affidavit_example_file")
                        .show();
                } else {
                    business_certificates_wrapper
                        .find(".business_certificates_id")
                        .html("");
                    business_certificates_wrapper
                        .find(".affidavit_example_file")
                        .hide();
                }

                if (curent_val == "Affidavit") {
                    $(".abriviations_text").show();
                } else {
                    $(".abriviations_text").hide();
                }
            });

            $(".abriviations_text").hide();
            $("#business_certificates_id").html("");
        },
    };

    function formatPhoneNumber(phoneNumberString) {
        var cleaned = ("" + phoneNumberString).replace(/\D/g, "");
        var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
        if (match) {
            return "(" + match[1] + ") " + match[2] + "-" + match[3];
        }
        return null;
    }

    function isValidEmail(email) {
        var pattern = new RegExp(
            /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i
        );
        return pattern.test(email);
    }

    if ($("#update-password-form").length) {
        $("#update-password-form").on("submit", function () {
            var errors = false;

            var passwordText = $("#password").val(),
                cpasswordText = $("#cpassword").val();

            if (passwordText == "") {
                errors = true;
                $("#password").addClass("errors");
                $("#password")
                    .parent()
                    .find("span")
                    .text("Please enter password.");
                $("#password").parent().find("span").addClass("show");
            } else if (cpasswordText == "") {
                errors = true;

                $("#password").removeClass("errors");
                $("#password").parent().find("span").text("");
                $("#password").parent().find("span").removeClass("show");

                $("#cpassword").addClass("errors");
                $("#cpassword")
                    .parent()
                    .find("span")
                    .text("Please enter confirm password.");
                $("#cpassword").parent().find("span").addClass("show");
            } else if (cpasswordText != passwordText) {
                errors = true;

                $("#password").removeClass("errors");
                $("#password").parent().find("span").text("");
                $("#password").parent().find("span").removeClass("show");

                $("#cpassword").addClass("errors");
                $("#cpassword")
                    .parent()
                    .find("span")
                    .text("Confirm password does not match.");
                $("#cpassword").parent().find("span").addClass("show");
            } else {
                $("#password").removeClass("errors");
                $("#cpassword").removeClass("errors");

                $("#password").parent().find("span").text("");
                $("#password").parent().find("span").removeClass("show");

                $("#cpassword").parent().find("span").text("");
                $("#cpassword").parent().find("span").removeClass("show");
            }

            if (errors) {
                return false;
            }
        });
    }

    if ($("#login-form").length) {
        $("#login-form").on("submit", function () {
            var email = $("#email");
            var password = $("#password");
            var errMsg = {};

            var errors = false;
            console.log(email.val());

            if (email.val() === "") {
                email.addClass("errors");
                errMsg.email = "Enter an email address";
                errors = true;
            } else if (!isValidEmail(email.val())) {
                email.addClass("errors");
                errors = true;
                errMsg.email = "Enter a valid email address";
            } else {
                email.removeClass("errors");
            }

            if (password.val() === "") {
                errors = true;
                password.addClass("errors");
                //errors.password = "Please enter Password";
            } else {
                password.removeClass("errors");
            }

            if (errors) {
                return false;
            }
        });
    }
    if ($("#signup-form").length) {
        $("#signup-form").on("submit", function () {
            var name = $("#name");
            var email = $("#email");
            var password = $("#password");
            var cpassword = $("#cpassword");

            var errors = false;

            if (name.val() === "") {
                name.addClass("errors");
                errors = true;
            } else if (email.val() === "") {
                name.removeClass("errors");
                email.addClass("errors");
                errors = true;
            } else if (!isValidEmail(email.val())) {
                name.removeClass("errors");
                email.addClass("errors");
                errors = true;
            } else if (password.val() === "") {
                email.removeClass("errors");
                password.addClass("errors");

                errors = true;
            } else if (cpassword.val() === "") {
                password.removeClass("errors");
                cpassword.addClass("errors");

                errors = true;
            } else if (cpassword.val() !== password.val()) {
                password.removeClass("errors");
                cpassword.addClass("errors");

                errors = true;
            } else {
                cpassword.removeClass("errors");
            }

            if (errors) {
                return false;
            }
        });
    }

    $("#business_name").on("blur", function () {
        var businessName = $(this).val();

        if ($("#business_dba").val() === "") {
            $("#business_dba").val(businessName);
        }
    });

    if ($("#add-bussiness").length) {
        var exstingEmailerrors = false;

        $(".add-my-business").on("click", function () {
            $("body").addClass("adding-business");
        });

        $("#add-bussiness #email").on("blur", function () {
            var emailInput = $(this);
            var email = emailInput.val();

            if (email == "" || !isValidEmail(email)) {
                emailInput.addClass("errors");
                emailInput
                    .parent()
                    .find(".errMsg")
                    .text("Enter a valid email address.");
                errors = true;
            } else {
                var actionUrl = $("#add-bussiness").attr("action");

                $.ajax({
                    method: "POST",
                    url: actionUrl,
                    data: { email: email, type: "validateEmail" },
                    success: function (res) {
                        // console.log("Res :", res);

                        if (res.type === "error") {
                            $("#add-bussiness #email").addClass("errors");
                            $("#add-bussiness #email")
                                .parent()
                                .find(".errMsg")
                                .text(res.message);
                            $("#add-bussiness #email")
                                .parent()
                                .find(".errMsg")
                                .show();
                            exstingEmailerrors = true;
                        } else {
                            $("#add-bussiness #email").removeClass("errors");
                            $("#add-bussiness #email")
                                .parent()
                                .find(".errMsg")
                                .text("");
                            $("#add-bussiness #email")
                                .parent()
                                .find(".errMsg")
                                .hide();
                            exstingEmailerrors = false;
                        }
                    },
                });
            }
        });

        $("#previous-step").on("click", function () {
            $(".form-steps").removeClass("active");
            $("#step-1").addClass("active");
        });

        $("#next-step").on("click", function () {
            var errors = verify_step_previous_fields();

            if (!errors) {
                $(".form-steps").removeClass("active");
                $("#step-2").addClass("active");
            } else {
                $(".form-control.errors")[0].focus();
            }

            return false;
        });

        $("#verify-later").on("click", function () {
            var errros = verify_step_previous_fields();
            if (!errros) {
                $("#verify_business_later").val("yes");
                save_business();
            } else {
                $(".form-steps").removeClass("active");
                $("#step-1").addClass("active");
                $(".form-control.errors")[0].focus();
            }
        });

        $("#submit-btn").on("click", function () {
            var errors = false;
            $("#verify_business_later").val("");

            var errros = verify_step_previous_fields();
            if (errros) {
                $(".form-steps").removeClass("active");
                $("#step-1").addClass("active");
                $(".form-control.errors")[0].focus();
            }

            $.each($("#step-2 .required"), function (index, field) {
                if (field.value === "") {
                    field.classList.add("errors");
                    errors = true;
                } else {
                    if (field.type !== "email") {
                        field.classList.remove("errors");
                    }
                }
            });

            if (errors) {
                $(".form-control.errors")[0].focus();
            } else {
                save_business();
            }
        });

        function verify_step_previous_fields() {
            var errors = false;
            $.each($("#step-1 .required"), function (index, field) {
                if (field.value === "") {
                    field.classList.add("errors");
                    errors = true;
                } else {
                    if (field.type !== "email") {
                        field.classList.remove("errors");
                    }
                }

                if (field.type === "email" && !isValidEmail(field.value)) {
                    field.classList.add("errors");
                    $(this)
                        .parent()
                        .find(".errMsg")
                        .text("Enter a valid email address.");
                    $(this).parent().find(".errMsg").show();
                    errors = true;
                } else if (
                    field.type === "email" &&
                    isValidEmail(field.value)
                ) {
                    if (!exstingEmailerrors) {
                        field.classList.remove("errors");
                        $(this).parent().find(".errMsg").text("");
                    } else {
                        errors = true;
                    }
                }
            });
            return errors;
        }

        function save_business() {
            if ($("#is_saving").val() !== "yes") {
                $("#add-bussiness .save-btn").val("Saving...");
                $("#is_saving").val("yes");

                var form = document.getElementById("add-bussiness");
                var tempData = new FormData(form);

                if (business_logo) {
                    tempData.append(
                        "business_logo_2",
                        business_logo,
                        "business_logo.jpg"
                    );
                }

                // return false;
                var actionUrl = $("#add-bussiness").attr("action");
                var pageUrl = $("#claim-business-request").data("pageurl");

                $.ajax({
                    method: "POST",
                    url: actionUrl,
                    data: tempData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        // console.log("Res :", res);

                        pageUrl +=
                            "?type=" + res.type + "&message=" + res.message;
                        // console.log(pageUrl);
                        window.location.href = pageUrl;
                    },

                    error: function () {
                        // avatar.src = initialAvatarURL;
                    },

                    complete: function (res) {
                        // console.log("Res :", res);
                        // pageUrl +=
                        //     "?type=" + res.type + "&message=" + res.message;
                        // console.log(pageUrl);
                        // window.location.href = pageUrl;
                    },
                });
            }
        }
    }

    if ($("#edit-bussiness").length) {
        var pageUrl = window.location.href;

        $("#edit-bussiness").on("submit", function () {
            var errors = false;

            $.each($("#edit-bussiness .required"), function (index, field) {
                if (field.value === "") {
                    field.classList.add("errors");
                    errors = true;
                    // console.log(field);
                } else {
                    field.classList.remove("errors");
                }

                if (field.type === "email" && !isValidEmail(field.value)) {
                    field.classList.add("errors");
                    errors = true;
                } else if (
                    field.type === "email" &&
                    isValidEmail(field.value)
                ) {
                    field.classList.remove("errors");
                }
            });

            // console.log("noteid", $("#remove_notes").val());

            // console.log("Errors", errors);

            if (errors) {
                $(".form-control.errors")[0].focus();
            } else {
                if ($("#is_saving").val() !== "yes") {
                    $("#edit-bussiness .btn").val("Saving...");
                    $("#is_saving").val("yes");

                    var form = document.querySelector("form");
                    var tempData = new FormData(form);
                    // var tempData = $(this).serialize();

                    if (business_logo) {
                        tempData.append(
                            "business_logo_2",
                            business_logo,
                            "business_logo.jpg"
                        );
                    }

                    // return false;
                    var actionUrl = $(this).attr("action");

                    $.ajax({
                        method: "POST",
                        url: actionUrl,
                        data: tempData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            // console.log("Res :", res);

                            pageUrl +=
                                "?type=" + res.type + "&message=" + res.message;
                            // console.log(pageUrl);
                            window.location.href = pageUrl;
                        },
                        error: function () {
                            // avatar.src = initialAvatarURL;
                        },
                        complete: function (res) {
                            // console.log("test", res);
                        },
                    });
                }
            }
            return false;
        });
    }

    function show_details_click() {
        $(".show-details").off();
        $(".show-details").on("click", function () {
            var id = $(this).data("id"),
                tempBus = business[id];

            // console.log("test");

            // console.log("id :", id);
            // console.log("tempBus", id, tempBus, business);
            console.log("tempBus", tempBus);

            if (tempBus.business_claim_status == "") {
                $(".claim-company-btn").html(claim_company_btn_html);
                themefunction.claim_business_request();
            } else {
                $(".claim-company-btn").html("");
            }

            // $("#details-popup .modal-title").text(tempBus.business_name);

            var businessName = tempBus.business_dba
                ? tempBus.business_dba
                : tempBus.business_name;

            $("#claim_business_request").data("businessid", id);
            $("#details-popup .company_name").text(businessName);
            $("#details-popup .products-services").text(tempBus.business_desc);

            if (tempBus.business_logo != "") {
                const business_logo_img =
                    $("#details-popup #company_logo_img").data("baseurl") +
                    "/" +
                    tempBus.business_logo;
                $("#details-popup #company_logo_img").attr(
                    "src",
                    business_logo_img
                );
                $("#details-popup #company_logo_img").show();
            } else {
                $("#details-popup #company_logo_img").hide();
            }

            var emailTexta = `<a href="mailto:${tempBus.business_email}">${tempBus.business_email}</a>`;
            $("#details-popup .email").html(emailTexta);

            var business_phone = `<a href="tel:${tempBus.business_phone}">${tempBus.business_phone}</a>`;
            $("#details-popup .phone").html(business_phone);

            var website = `<a href="${tempBus.business_address.website}">${tempBus.business_address.website}</a>`;
            $("#details-popup .website").html(website);

            if (tempBus.business_address.website) {
                $("#show_website").show();
            } else {
                $("#show_website").hide();
            }

            if (
                tempBus.business_fields.primary_poc_first_name ||
                tempBus.business_fields.primary_poc_last_name
            ) {
                var poc_name =
                    tempBus.business_fields.primary_poc_first_name
                        .fields_value +
                    " " +
                    tempBus.business_fields.primary_poc_last_name.fields_value;
                $("#details-popup .primary_poc_name").text(poc_name);
            }
            if (tempBus.business_fields.primary_poc_email) {
                var emailText =
                    "<a href='mailto:" +
                    tempBus.business_fields.primary_poc_email.fields_value +
                    "'>" +
                    tempBus.business_fields.primary_poc_email.fields_value +
                    "</a>";
                $("#details-popup .primary_poc_email").html(emailText);
            }
            if (tempBus.business_fields.primary_poc_phone) {
                var phoneText =
                    "<a href='tel:" +
                    tempBus.business_fields.primary_poc_phone.fields_value +
                    "'>" +
                    tempBus.business_fields.primary_poc_phone.fields_value +
                    "</a>";
                $("#details-popup .primary_poc_phone").html(phoneText);
            }
            // console.log(
            //     "tempBus.business_address.is_address_hidden",
            //     tempBus.business_address.is_address_hidden
            // );

            var address = "";
            if (tempBus.business_address.is_address_hidden != "yes") {
                address = tempBus.business_address.address + "<br/>";
            }

            var city = tempBus.business_address.city;
            var state = tempBus.business_address.state;

            address +=
                city.toLowerCase() +
                ", " +
                state.toLowerCase() +
                " - " +
                tempBus.business_address.zipcode;
            $("#details-popup .address").html(address);
            $("#show_address").show();

            if (tempBus.primary_category) {
                $("#details-popup .primary_category").text(
                    tempBus.primary_category
                );
                $("#details-popup #primary-category").show();
            } else {
                $("#details-popup #primary-category").hide();
            }

            var busOwners = tempBus.business_owners;
            var ownersHhtml = "";

            busOwners.map((owner) => {
                ownersHhtml += `<div class="owner">
                <h3 class="owner-name">${owner.owner_name}</h3>
                <span class="item"><a href="mailto:${owner.owner_email}"><i class="fas fa-envelope"></i> <span class="owner-email">${owner.owner_email}</span></a></span>                
                <span class="item"><a href="tel:${owner.owner_phone}"><i class="fas fa-mobile-alt"></i> <span class="owner-phone">${owner.owner_phone}</span></a></span>`;
                // '<span class="item"><i class="fas fa-users"></i> <span class="owner-race">${owner.owner_race}</span></span>'
                // if (owner.percentage) {
                //     ownersHhtml += `<span class="item"><i class="fas fa-percentage"></i> <span class="owner-percentage">${owner.percentage}</span></span>`;
                // }
                ownersHhtml += `</div>`;
            });

            $("#details-popup .owners").html(ownersHhtml);

            var socialMedias = tempBus.business_fields.social_media;

            var socialMediaHtml = "";
            if (socialMedias && socialMedias[0].social_media !== "") {
                socialMedias.map((social) => {
                    var fontIcon = "";
                    switch (social.social_media) {
                        case "facebook":
                            fontIcon = "fa-facebook-square";
                            break;
                        case "instagram":
                            fontIcon = "fa-instagram";
                            break;
                        case "twitter":
                            fontIcon = "fa-twitter";
                            break;
                        case "linkedin":
                            fontIcon = "fa-linkedin";
                            break;
                        case "youtube":
                            fontIcon = "fa-youtube";
                            break;
                        default:
                            fontIcon = "";
                            break;
                    }

                    socialMediaHtml += `<div class="social">
                        <a href="${social.social_link}" class="social-link"><i class="fab ${fontIcon}"></i></a>
                    </div>`;
                });
            }
            // console.log("socialMediaHtml : ", socialMedias);
            if (socialMediaHtml) {
                $("#details-popup .social-medias").html(socialMediaHtml);
                $("#details-popup #social-medias").show();
            } else {
                $("#details-popup #social-medias").hide();
            }

            // $("#details-popup .phone").text(tempBus.business_name);
        });
    }

    function show_phone_click() {
        if ($(window).width() > 767) {
            $(".desktop-phone-number").show();
            $(".mobile-phone-number").hide();
        } else {
            $(".desktop-phone-number").hide();
            $(".mobile-phone-number").show();
        }

        $(".show-phone").off();

        $(".show-phone").on("click", function () {
            var phone = $(this).data("phone");
            var bus_title = $(this).data("bustitle");

            // console.log("Phone :", phone);

            $(".phone-text").text(phone);
            $(".modal-title span").text(bus_title);
            $("#phone-popup").modal("show");
            return false;
        });

        return false;
    }

    if ($("#basic_waypoint").length > 0) {
        var waypoints = $("#basic_waypoint").waypoint({
            handler: function (direction) {
                if (direction === "down" && $("#basic_waypoint").length > 0) {
                    $("#basic_waypoint a").trigger("click");
                }
            },
            offset: "98%",
        });
    }

    $(".load-more a").on("click", function () {
        var url = $(this).data("url"),
            loading = $(this).data("loading"),
            page = $(this).data("page"),
            btnText = $(this).html(),
            category = $("#primary_category").val(),
            search = $("#search").val(),
            btn = $(this);

        if (loading == "no") {
            $(this).data("loading", "yes");
            btn.html('<i class="fas fa-spinner fa-spin"></i>');

            url = `${url}?page=${page}&primary_category=${category}&search=${search}`;

            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                complete: function (response) {
                    response = response.responseJSON;
                    var type =
                        response.type == "error" ? "danger" : response.type;

                    html = response.html;

                    $("#search_results tbody").append(html);
                    Waypoint.refreshAll();
                    show_details_click();

                    btn.html(btnText);
                    btn.data("loading", "no");
                    show_phone_click();

                    if (response.pagging.next != "disable") {
                        btn.data("page", response.pagging.next);
                        // console.log(btn.data("page"));
                    } else {
                        $(".load-more").remove();
                    }
                },
            });
        }

        return false;
    });

    $("#request-business .close,#request-business .close-modal").on(
        "click",
        function () {
            var closeModal = confirm(
                "This action will cause you to lose your work. Are you sure you want to continue?"
            );
            if (closeModal) {
                $("#add-bussiness")[0].reset();
                $("#request-business").modal("hide");
                $("body").removeClass("adding-business");
            }
            return false;
        }
    );

    $("#claim-business-request").on("submit", function () {
        var errors = false;
        $.each($("#claim-business-request .required"), function (index, field) {
            if (field.value === "") {
                field.classList.add("errors");
                errors = true;
            } else {
                if (field.type !== "email") {
                    field.classList.remove("errors");
                }
            }
        });

        var email = $("#request_email").val(),
            cemail = $("#confirm_request_email").val();

        console.log(email, cemail);

        if (cemail != "") {
            var errDiv = $("#confirm_request_email").parent().find(".errMsg");
            if (email != cemail) {
                console.log("test");
                $("#confirm_request_email").addClass("errors");
                errDiv.html("Please enter same confirm email");
                errDiv.show();
                errors = true;
            } else {
                console.log("test 1");
                errDiv.html("");
                errDiv.hide();
                $("#confirm_request_email").removeClass("errors");
            }
        }

        if (errors) {
            $(".form-control.errors")[0].focus();
        } else {
            if ($("#claim_business_save_btn").val() !== "yes") {
                $("#claim-business-request .save-btn").val("Saving...");
                $("#claim_business_save_btn").val("yes");

                var form = document.getElementById("claim-business-request");
                var tempData = new FormData(form);
                var pageUrl = $("#claim-business-request").data("pageurl");
                // var tempData = $("#claim-business-request").serialize();

                // return false;
                var actionUrl = $(this).attr("action");

                $.ajax({
                    url: actionUrl,
                    type: "POST",
                    data: tempData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        // console.log(res);
                        pageUrl +=
                            "?type=" + res.type + "&message=" + res.message;

                        window.location.href = pageUrl;
                    },

                    error: function () {
                        // avatar.src = initialAvatarURL;
                    },

                    complete: function (res) {
                        // console.log(res);
                    },
                });
            }
        }

        return false;
    });

    show_phone_click();

    $(window).on("load", function () {
        themefunction.addOwner();
        themefunction.removeOwner();
        themefunction.fillPocContent();
        themefunction.addAdminNotes();
        themefunction.removeAdminNotes();
        themefunction.addSocialMedia();
        themefunction.removeSocialMedia();
        themefunction.addCertificate();
        themefunction.removeCertificate();
        themefunction.changeCertificate();
        themefunction.formatePhone();
        themefunction.business_verification();
        show_details_click();

        $(".search-results").addClass("hide-loader");
    });

    if ($("#add-bussiness").length) {
        window.addEventListener("DOMContentLoaded", function () {
            var avatar = document.getElementById("preview-image");
            var image = document.getElementById("image");
            var input = document.getElementById("upload_image");
            var $modal = $("#crop-img-modal");
            var crop_image_btn = $("#crop_image");
            var crop_image_btn_text = crop_image_btn.html();
            var cropper;

            input.addEventListener("change", function (e) {
                var files = e.target.files;
                var done = function (url) {
                    input.value = "";
                    image.src = url;
                    $modal.modal("show");
                };
                var reader;
                var file;
                var url;

                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $modal
                .on("shown.bs.modal", function () {
                    cropper = new Cropper(image, {
                        // aspectRatio: 1,
                        viewMode: 0,
                    });
                })
                .on("hidden.bs.modal", function () {
                    cropper.destroy();
                    cropper = null;
                });

            document
                .getElementById("crop_image")
                .addEventListener("click", function () {
                    var initialAvatarURL;
                    var canvas;

                    if (cropper) {
                        canvas = cropper.getCroppedCanvas({
                            width: 600,
                            height: 600,
                            imageSmoothingEnabled: false,
                            imageSmoothingQuality: "high",
                        });

                        initialAvatarURL = avatar.src;
                        avatar.src = canvas.toDataURL();

                        canvas.toBlob(function (blob) {
                            business_logo = blob;

                            $modal.modal("hide");
                            console.log("test");
                            setTimeout(() => {
                                if ($("body").hasClass("adding-business")) {
                                    console.log("test 3");
                                    $("body").addClass("modal-open");
                                }
                            }, 1000);
                        });
                    }
                });
        });

        $("#verify_business_later").on("change", function () {
            if ($(this).prop("checked")) {
                $("#business_verification_wrapper").html("");
            } else {
                $("#business_verification_wrapper").html(
                    business_verification_wrapper
                );
                $(".affidavit_example_file").hide();
                themefunction.business_verification();
            }
        });

        $(".verify-business-btn").on("click", function () {
            var business_id = $(this).data("id"),
                business_title = $(this).data("title"),
                edit_link = $(this).data("link");

            $("#business_certificate_verification_modal .modal-title").text(
                business_title
            );
            $("#business_certificate_verification_modal .business_id").val(
                business_id
            );
            $(
                "#business_certificate_verification_modal .business_edit_link"
            ).attr("href", edit_link);

            $("#business_certificate_verification_modal").modal("show");
            return false;
        });

        $("#business_certificate_verification").on("submit", function () {
            var errors = false;

            $.each(
                $("#business_certificate_verification .required"),
                function (index, field) {
                    if (field.value === "") {
                        field.classList.add("errors");
                        errors = true;
                    } else {
                        if (field.type !== "email") {
                            field.classList.remove("errors");
                        }
                    }
                }
            );

            if (errors) {
                $(".form-control.errors")[0].focus();
                return false;
            }
        });
    }

    if ($(".business_logo_image .remove-img").length) {
        $(".business_logo_image .remove-img").on("click", function () {
            $("#preview-image").attr("src", "");
            $("#remove_business_logo").val("yes");
        });
    }

    $("#confirm_request_email").on("cut copy paste", function (e) {
        e.preventDefault();
    });
})(jQuery);
