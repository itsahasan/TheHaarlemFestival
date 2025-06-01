function getTourGuides(){
    axios
        .get('/tourGuide/getAll')
        .then(res => {
            res.data.forEach(guide => {
                displayOnHistoryPage(guide);
            })
        })
        .catch((error) => console.log(error));
}

function displayOnHistoryPage(guide) {
    //storing and afterwards loading the data from the database
    const container = document.getElementById('guideContainer');

    const cardHistory = document.createElement('div');
    cardHistory.className = 'card col-12 p-0 my-4';

    cardHistory.style = 'border: 0;'
    const row = document.createElement('div');
    row.className = 'row';

    const leftCol = document.createElement('div');
    leftCol.className = 'col-6';

    const rightCol = document.createElement('div');
    rightCol.className = 'col-6';

    const imageHistory = document.createElement('img');
    imageHistory.src = guide.image;
    imageHistory.className = 'w-100'

    const nameOfGuide = document.createElement('h2');
    nameOfGuide.innerText = guide.name;
    nameOfGuide.className = 'card-title';
    nameOfGuide.style = 'color: darkred;';

    const descriptionOfGuide = document.createElement('p');
    descriptionOfGuide.innerText = guide.description;
    descriptionOfGuide.className = 'card-description';

    cardHistory.append(imageHistory, nameOfGuide, descriptionOfGuide);
    container.appendChild(cardHistory);

    rightCol.append(nameOfGuide, descriptionOfGuide);
    leftCol.append(imageHistory);
    row.append(rightCol, leftCol);
    cardHistory.append(row);
    container.appendChild(cardHistory);
}