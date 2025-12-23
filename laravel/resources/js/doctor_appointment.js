let patientNamePlaceholder = document.getElementById('patient-name-placeholder');
let patientIdSelect = document.getElementById('patient_id');
let lastUpdated = patientNamePlaceholder;

patientIdSelect.addEventListener("change", (event) => {
    setPatientName();  
});


window.onload = function() 
{
    setPatientName();
};

function setPatientName()
{
    let patientId = patientIdSelect.value;
    
    if (patientId)
    {
        let selected = document.getElementById(`patient-name-${patientId}`);

        lastUpdated.hidden = true;
        lastUpdated = selected;
        
        selected.hidden = false;
    }
}

