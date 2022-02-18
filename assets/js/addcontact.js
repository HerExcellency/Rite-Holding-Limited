
$(document).ready(() => {

    $('#contact-btn').on('click', (e) => {
        e.preventDefault()
        let fullname = $('#fullname').val()
        let subject = $('#subject').val()
        let phone = $('#mobile').val()
        let email = $('#email').val()
        let desc = $('#message').val()
        fullname = fullname.trim()
        subject = subject.trim()
        phone = phone.trim()
        desc = desc.trim()
        email = email.trim()



        if (fullname === "" || fullname.length < 4 || fullname.split(" ").length < 2) {
            return showError("A valid full name is required")
        }

        if (email == "") {
            return showError("Email is required")
        }
        if (phone === "" || phone.length < 6 || phone.length > 16) {
            return showError("A valid phone number is required")
        }
        if (subject === "" || subject.length < 10) {
            return showError("Subject must be more than 10 characters")
        }
        if (desc === "" || desc.length < 10) {
            return showError("Description must be more than 10 characters")
        }

        var formData = new FormData()

        formData.append('fullname', fullname)
        formData.append('subject', subject)
        formData.append('email', email)
        formData.append('phone', phone)
        formData.append('desc', desc)

        let submitBtn = $('#contact-btn')
        var url = baseURL + '/contact'
        submitBtn.prop('disabled', true)
        showError("Loading please wait...")
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(res => res.json()).then(data => {
            if (data.error) {
                submitBtn.prop('disabled', false)
                return showError(data.error)
            }
            if (data.status) {
                showSuccess('Your Message has been submitted!')
                setTimeout(e => {
                    location.reload()
                }, 5000)
            } else {
                submitBtn.prop('disabled', false)
                return showError('Could not connect')
            }
        }).catch(e => {
            submitBtn.prop('disabled', false)
            return showError('Could not connect to the server')
        })
    })


})

