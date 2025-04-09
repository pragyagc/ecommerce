const mobileInput = document.getElementById('mobile');
const sendOtpBtn = document.getElementById('sendOtpBtn');
const otpSection = document.getElementById('otpSection');
const otpInput = document.getElementById('otp');
const verifyOtpBtn = document.getElementById('verifyOtpBtn');
const payBtn = document.getElementById('payBtn');
const paymentStatus = document.getElementById('paymentStatus');

// Send OTP Logic
sendOtpBtn.addEventListener('click', async () => {
    const mobile = mobileInput.value.trim();

    if (mobile.length !== 10 || !/^\d{10}$/.test(mobile)) {
        paymentStatus.innerText = 'Enter a valid 10-digit mobile number.';
        paymentStatus.style.color = 'red';
        return;
    }

    try {
        const response = await fetch('backend/send_otp.php', { // Update URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ mobile })
        });

        const result = await response.json();

        if (result.success) {
            otpSection.style.display = 'block';
            paymentStatus.innerText = 'OTP sent successfully!';
            paymentStatus.style.color = 'green';
        } else {
            paymentStatus.innerText = result.message || 'Failed to send OTP.';
            paymentStatus.style.color = 'red';
        }
    } catch (error) {
        paymentStatus.innerText = 'Error sending OTP. Please try again.';
        paymentStatus.style.color = 'red';
    }
});

// Verify OTP Logic
verifyOtpBtn.addEventListener('click', async () => {
    const otp = otpInput.value.trim();

    if (otp.length !== 6 || !/^\d{6}$/.test(otp)) {
        paymentStatus.innerText = 'Enter a valid 6-digit OTP.';
        paymentStatus.style.color = 'red';
        return;
    }

    try {
        const response = await fetch('backend/verify_otp.php', { // Update URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ mobile: mobileInput.value, otp })
        });

        const result = await response.json();

        if (result.success) {
            paymentStatus.innerText = 'OTP verified successfully!';
            paymentStatus.style.color = 'green';
            payBtn.disabled = false; // Enable payment button
        } else {
            paymentStatus.innerText = result.message || 'Invalid OTP.';
            paymentStatus.style.color = 'red';
        }
    } catch (error) {
        paymentStatus.innerText = 'Error verifying OTP. Please try again.';
        paymentStatus.style.color = 'red';
    }
});

// Form Validation
document.getElementById('paymentForm').addEventListener('submit', function (event) {
    const mpin = document.getElementById('mpin').value.trim();

    if (mpin.length < 4 || mpin.length > 6 || !/^\d+$/.test(mpin)) {
        event.preventDefault();
        paymentStatus.innerText = 'MPIN must be between 4 and 6 digits.';
        paymentStatus.style.color = 'red';
    }
});