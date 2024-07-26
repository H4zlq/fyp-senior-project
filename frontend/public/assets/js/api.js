const code = $('#python');
const language = $('#language');
const btnConvert = $('#btn-convert');
let loading = false;

function showAlert(message, redirect) {
    $("#alert").text(message);
    $("#alert").show("slow");

    // Scroll to the top of the page
    $("html, body").animate({ scrollTop: 0 }, "slow");

    if (redirect) {
        $("#alert").click(function () {
            window.location.href = redirect;
        });
    }

    setTimeout(function () {
        $("#alert").hide("slow");
    }, 5000);
}

async function handleApi() {
    if (loading) return;

    setLoading(true);

    const id = btnConvert.data('id');

    try {
        const response = await fetch(`http://localhost:5000/api/convert/${language.val()}`, {
            method: 'POST',
            body: JSON.stringify({ id: id || '', code: code.val() }),
            headers: { 'Content-Type': 'application/json' },
        });

        // Check for successful responses
        if (!response.ok) {
            if (response.status === 400) {
                const data = await response.json();
                console.error('Error:', data.error);
                showAlert(data.error, '/subscription');
            }
        }

        const data = await response.json();

        // Handle successful responses (assuming data contains converted code)
        typeEffect(data[0], '.language', 100);
        typeEffect(data[1], '.output', 100);
    } catch (error) {
        console.error('Error:', error.message);
        // Handle errors here (e.g., display an error message to the user)
    } finally {
        setLoading(false);
    }
}

function setLoading(loader) {
    btnConvert.prop('disabled', loader);
    btnConvert.toggleClass('btn-loading');
    loading = loader;
}

function typeEffect(response, selector, delay) {
    $(selector).html('');

    setTimeout(() => {
        appendText(response, selector, delay);
    }, delay);
}

function appendText(response, selector, delay) {
    let i = 0;

    const interval = setInterval(() => {
        $(selector).append(response[i]);

        i++;

        if (i >= response.length) {
            clearInterval(interval);
        }
    }, delay);
}

// Event listener for button click
btnConvert.on('click', handleApi);
