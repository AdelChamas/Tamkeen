import axios from "axios";

let errors = [];


/**
 *
 * @param {HTMLDom} parent_id the choices container for the current question
 */
function newChoice(parent_id){
    const question_number = parent_id.split('-')[1];
    const choice_number = numberOfChoices(question_number) + 1
    parent = document.getElementById(parent_id);
    const container = document.createElement("div");
    container.classList.add("choice");
    container.id = `q-${question_number}-c-${choice_number}`

    const input = document.createElement("input");
    input.type = 'text';

    const mark_valid = document.createElement("i");
    mark_valid.classList.add("bi");
    mark_valid.classList.add("bi-check2")
    mark_valid.addEventListener("click", () => {
        // if yes notify that it will be removed.
        if(container.id.includes('correct')){
            container.id = `q-${question_number}-c-${choice_number}`
            mark_valid.style.border = "1px solid red";
            mark_valid.style.color = 'red';
        }else{
            container.id = `q-${question_number}-c-${choice_number}-correct`
            mark_valid.style.border = "1px solid green";
            mark_valid.style.color = 'green';
        }
    });
    const remove = document.createElement("i");
    remove.classList.add("bi")
    remove.classList.add("bi-x-lg")
    remove.addEventListener("click", ()=>{
        removeChoice(`q-${question_number}-c-${choice_number}`)
    });


    container.appendChild(input);
    container.appendChild(mark_valid);
    container.appendChild(remove);

    parent.appendChild(container);

}

/**
 * Given the question number return the number of choices
 *
 * @param {Id} question_nb
 * @returns
 */
function numberOfChoices(question_nb){
    return Array.from(document.querySelectorAll(`#q-${question_nb} .choices .choice`)).length;
}


/**
 * Remove the given choice from a question
 *
 * @param {*} choice_id
 */
function removeChoice(choice_id){
    let choice = document.getElementById(choice_id);
    if(choice === null){
        choice = document.getElementById(`${choice_id}-correct`)
    }
    choice.remove();
}





const new_question = document.getElementById("new-question");
new_question.addEventListener("click", (e)=>{
    e.preventDefault();
    newQuestion();
})

const exam_submit = document.getElementById("exam-submit");
exam_submit.addEventListener("click", (e)=>{
    e.preventDefault();
    let exam = {};
    const questions = Array.from(document.querySelectorAll('.question'));
    questions.forEach(question => {
        const question_id = question.id.split('-')[1];
        const question_number = document.getElementById(`q-${question_id}-number`).value

        const choices_ = [];
        const correct_choices = [];

        const choices = Array.from(document.querySelectorAll(`#q-${question_id} .choices .choice`));


        if(document.getElementById(`q-${question_id}-q`).value == ''){
            errors.push(`Question ${question_number} is empty`)
        }else if(document.getElementById(`q-${question_number}-grade`).value == ''){
            errors.push(`Question ${question_number} grade is empty`)
        }

        exam[`Question-${question_number}`] = {
            "Question": document.getElementById(`q-${question_id}-q`).value,
        }
        choices.forEach(choice => {
            if(choice.firstChild.value == ''){
                errors.push(`Question ${question_number} Choice ${choice.id.split('-')[3]} is empty.`)
            }
            if(choice.id.includes('correct')){
                correct_choices.push(choice.id.split('-')[3])
                choices_.push(choice.firstChild.value);
            }else{
                choices_.push(choice.firstChild.value)
            }
        });

        if(choices.length < 2){
            if(! errors.includes("At least two choices must be provided for each question.")){
                errors.push("At least two choices must be provided for each question.");
            }
        }
        if(correct_choices.length == 0){
            if(! errors.includes("At least one choice must be marked as correct for each question.")){
                errors.push("At least one choice must be marked as correct for each question.");
            }
        }else if(correct_choices.length == choices.length){
            errors.push("Correct choices must be n-1, or add another choice 'All the above'");
        }
        exam[`Question-${question_number}`]["Grade"] = document.getElementById(`q-${question_number}-grade`).value;

        exam[`Question-${question_number}`]["Choices"] = choices_;
        exam[`Question-${question_number}`]["Correct"] = correct_choices;

    });
    if(errors.length > 0){
        renderErrors();
        return;
    }
    // console.log(exam);
    document.getElementById('submit').addEventListener('click', () => {
        document.getElementById('structure').value = JSON.stringify(exam);
    });
})

function numberOfQuestions(){
    const questions = Array.from(document.querySelectorAll("#ex-questions .question"));
    if(questions.length == 0){
        return 0;
    }
    return Number(questions[questions.length - 1].childNodes[1].value);
}

function newQuestion(){
    const question_number = numberOfQuestions() + 1;
    const parent = document.getElementById("ex-questions");


    const container = document.createElement("div");
    container.classList.add("question");
    container.id = (`q-${question_number}`);

    const title = document.createElement("h2");
    title.innerText = 'Question'

    const question__number = document.createElement("input");
    question__number.id = `q-${question_number}-number`;
    question__number.classList.add("question-nb")
    question__number.type = 'number';
    question__number.value = question_number

    const content_container = document.createElement("div");
    content_container.classList.add("ex-container");


    const left_content = document.createElement("div");
    left_content.classList.add("left");

    const question_container = document.createElement("div");
    question_container.classList.add('exam-question');
    question_container.id = `q-${question_number}-1`;

    const question_label = document.createElement("span");
    question_label.innerHTML = "Question"

    const question = document.createElement("input");
    question.type = "text";
    question.classList.add("question-question")
    question.id = `q-${question_number}-q`;

    question_container.appendChild(question_label);
    question_container.appendChild(question);




    const grade_container = document.createElement("div");
    grade_container.classList.add("grade");

    const grade_label = document.createElement("span");
    grade_label.innerHTML = "Grade";
    const grade = document.createElement("input");
    grade.type = "number";
    grade.classList.add("grade")
    grade.id = `q-${question_number}-grade`

    grade_container.appendChild(grade_label);
    grade_container.appendChild(grade);


    left_content.appendChild(question_container);
    left_content.appendChild(grade_container);



    const right_content = document.createElement("div");
    right_content.classList.add("right");

    const choices_label = document.createElement("h3");
    choices_label.innerText = "Choices";

    const new_choices = document.createElement("i");
    new_choices.id = `q-${question_number}-new-choice`;
    new_choices.classList.add("bi");
    new_choices.classList.add("bi-plus-circle");



    const choices_container = document.createElement("div");
    choices_container.classList.add("choices");
    choices_container.id = `q-${question_number}-c`;

    new_choices.addEventListener("click", () => {
        newChoice(`q-${question_number}-c`)
    });

    right_content.appendChild(choices_label);
    right_content.appendChild(new_choices);
    right_content.appendChild(choices_container);



    content_container.appendChild(left_content);
    content_container.appendChild(right_content);


    const remove_question = document.createElement("button");
    remove_question.innerHTML = "Remove";
    remove_question.classList.add("ex-btn");
    remove_question.id = `q-${question_number}-r`

    remove_question.addEventListener("click", () => {
        removeQuestion(`q-${question_number}`)
    });

    container.append(title);
    container.append(question__number);
    container.append(content_container);
    container.append(remove_question);

    parent.append(container);
}


function removeQuestion(id){
    document.getElementById(id).remove();
}


function renderErrors(){
    removePreviousErrors();
    const container = document.createElement("div");
    container.classList.add("ex-errors");
    errors.forEach((error) => {
        const error_span = document.createElement("h3");
        error_span.classList.add("error");
        error_span.innerHTML = error;
        container.appendChild(error_span);
    });

    errors = [];
    document.getElementsByClassName("ex-container")[0].insertAdjacentElement("afterbegin", container);
}


function removePreviousErrors(){
    const previous_errors = document.getElementsByClassName('ex-errors')[0];
    if(previous_errors != null){
        previous_errors.remove();
    }
}
