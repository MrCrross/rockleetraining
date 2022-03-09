function parents(elem, cl) {
    if (elem.parentElement.classList.contains(cl)) {
        return elem.parentElement
    } else {
        return parents(elem.parentElement, cl)
    }
}

function addExercise(e) {
    const template = document.getElementById('template')
        .querySelector('.accordion').cloneNode(true)
    const ws = e.target.parentElement.parentElement.querySelector('.workspace')
    const lastChild = ws.lastElementChild
    let lastLevel = 0
    if (lastChild) lastLevel = lastChild.querySelector('input[name="level"]').value
    const newLevel = Number(lastLevel) + 1
    const heading = template.querySelector('#heading')
    const button = template.querySelector('.accordion-button')
    const collapse = template.querySelector('#collapse')
    const destroy = template.querySelector('.btn-danger')
    const lvl = template.querySelector('input[name="level"]')

    template.querySelector('input[name="level"]').value = newLevel
    template.id = 'accordion' + newLevel
    heading.id = 'heading' + newLevel
    collapse.id = 'collapse' + newLevel
    button.dataset.bsTarget = '#' + collapse.id
    collapse.dataset.bsParent = '#' + template.id
    button.innerText = newLevel + ' упражнение'
    destroy.addEventListener('click', destroyExercise)
    lvl.addEventListener('change', updateExercise)
    ws.append(template)
}


function updateExercise(el) {
    const ws = parents(el,'workspace')
    const accordions = ws.querySelectorAll('.accordion')
    let level = 1
    let exercises = []
    accordions.forEach(function (elem) {
        exercises.push(elem.cloneNode(true))
        elem.remove()
    })
    for (let i = 0; i < exercises.length; i++) {
        for (let j = 1; j < exercises.length; j++) {
            if (exercises[j].querySelector('input[name="level"]').value
                < exercises[j - 1].querySelector('input[name="level"]').value) {
                const temp = exercises[j - 1]
                exercises.splice(j - 1, 1,exercises[j])
                exercises.splice(j, 1,temp)
            }
            if (exercises[j].querySelector('input[name="level"]').value
                === exercises[j - 1].querySelector('input[name="level"]').value) {
                const temp = exercises[j - 1]
                exercises.splice(j - 1, 1,exercises[j])
                exercises.splice(j, 1,temp)
            }
        }
    }
    exercises.forEach(function (elem) {
        if (elem.querySelector('input[name="level"]').value === level) {
            ws.append(elem)
        } else {
            const heading = elem.querySelector('.accordion-header')
            const button = elem.querySelector('.accordion-button')
            const collapse = elem.querySelector('.accordion-collapse')
            const lvl = elem.querySelector('input[name="level"]')
            const destroy = elem.querySelector('.btn-danger')

            elem.querySelector('input[name="level"]').value = level
            elem.id = 'accordion' + level
            heading.id = 'heading' + level
            collapse.id = 'collapse' + level
            button.dataset.bsTarget = '#' + collapse.id
            collapse.dataset.bsParent = '#' + elem.id
            button.innerText = level + ' упражнение'
            if (destroy) destroy.addEventListener('click', destroyExercise)
            lvl.addEventListener('change', updateExercise)
            ws.append(elem)
        }
        level = ++level
    })
}

function destroyExercise(e) {
    const i = e.target
    const exercise = parents(i, 'accordion')
    const ws = exercise.parentElement
    exercise.remove()
    updateExercise(ws.lastElementChild)
}

function submitForm(e) {
    e.preventDefault()
    const i = e.target
    const trainingType = i.querySelector('select[name="trainingType"]').value
    const user = i.querySelector('input[name="user"]')
    const id = i.querySelector('input[name="id"]')
    const nameTraining = i.querySelector('input[name="nameTraining"]').value
    const exerciseTypes = i.querySelectorAll('select[name="exerciseTypes"]')
    const nameExercises = i.querySelectorAll('input[name="nameExercise"]')
    const times = i.querySelectorAll('input[name="time"]')
    const descriptions = i.querySelectorAll('textarea[name="description"]')
    const levels = i.querySelectorAll('input[name="level"]')
    let url = '/api/trainings/insert'

    const training = {
        trainingType,
        nameTraining
    }
    if(user) training.user= user.value
    if(id) {
        training.id= id.value
        url = "/api/trainings/update"
    }
    const exercises = []
    exerciseTypes.forEach(function (elem, key) {
        exercises.push(JSON.stringify({
            exerciseType: elem.value,
            nameExercise: nameExercises[key].value,
            time: times[key].value,
            description: descriptions[key].value,
            level: levels[key].value
        }))
    })

    training.exercises = exercises
    const formData = new FormData;
    formData.set('training', JSON.stringify(training));

    fetch(url, {
        method: 'post',
        credentials: 'same-origin',
        body: formData
    })
        .then(() => location.reload())
}

function submitDeleteForm(e){
    if(confirm('Вы действительно хотите удалить тренировку?')){
        const formData = new FormData()
        formData.append('id',e.target.dataset.id)
        fetch('/api/trainings/delete',{
            method: "POST",
            credentials: "same-origin",
            body: formData
        })
            .then(()=>location.reload())
    }
}

function init() {
    const newExercise = document.querySelector('#newExercise')
    const createForm = document.getElementById('createTraining')
    const updateForm = document.querySelectorAll('.updateTraining')
    const deleteForm = document.querySelectorAll('.deleteTraining')
    const levels = document.querySelectorAll('input[name="level"]')
    const destroy = document.querySelector('.workspace').querySelectorAll('.btn-danger')
    if (newExercise) newExercise.addEventListener('click', addExercise)
    if (createForm) createForm.addEventListener('submit', submitForm)
    if (updateForm) updateForm.forEach(function (el) {
        el.addEventListener('submit', submitForm)
    })
    if (deleteForm) deleteForm.forEach(function (el) {
        el.addEventListener('click', submitDeleteForm)
    })
    levels.forEach(function (el) {
        el.addEventListener('change', (e)=>updateExercise(e.target))
    })
    if (destroy) destroy.forEach(function (el) {
        el.addEventListener('click', destroyExercise)
    })
}

init()