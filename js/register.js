(function() {
    const constraints = {
        username: {
            presence: true,
            length: {
                minimum: 3,
                maximum: 20
            },
            format: {
                pattern: "[a-z0-9]+",
                flags: "i",
                message: "can only contain a-z and 0-9"
            }
        },
        email: {
            presence: true,
            email: true,
        },
        password: {
            presence: true,
            length: {
                minimum: 5
            }
        },
        "confirm-password": {
            presence: true,
            equality: {
                attribute: "password",
                message: "^The passwords does not match"
            }
        },
    };

    const inputs = document.querySelectorAll("input");
    for (let i = 0; i < inputs.length; ++i) {
        inputs.item(i).addEventListener("change", function(event) {
            const errors = validate(form, constraints) || {};
            showErrorsForInput(this, errors[this.name]);
        });
    }

    function showErrorsForInput(input, errors) {
        const formGroup = closestParent(input.parentNode, "form-group"),
            messages = formGroup.querySelector(".messages");
        resetFormGroup(formGroup);
        if (errors) {
            formGroup.classList.add("has-error");
            _.each(errors, function(error) {
                addError(messages, error);
            });
        } else {
            formGroup.classList.add("has-success");
        }
    }

    function closestParent(child, className) {
        if (!child || child == document) {
            return null;
        }
        if (child.classList.contains(className)) {
            return child;
        } else {
            return closestParent(child.parentNode, className);
        }
    }

    function resetFormGroup(formGroup) {
        formGroup.classList.remove("has-error");
        formGroup.classList.remove("has-success");
        _.each(formGroup.querySelectorAll(".help-block.error"), function(element) {
            element.parentNode.removeChild(element);
        });
    }

    function addError(messages, error) {
        const block = document.createElement("p");
        block.classList.add("help-block");
        block.classList.add("error");
        block.classList.add("text-danger");
        block.innerText = error;
        messages.appendChild(block);
    }

    const form = document.getElementById("main");
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        handleFormSubmit(form);
    });

    function handleFormSubmit(form) {
        const errors = validate(form, constraints);
        showErrors(form, errors || {});
        if (!errors) {
            showSuccess();
        }
    }

    function showErrors(form, errors) {
        _.each(form.querySelectorAll("input[name]"), function(input) {
            showErrorsForInput(input, errors && errors[input.name]);
        });
    }

    function showSuccess() {
        alert("Success!");
    }
})();