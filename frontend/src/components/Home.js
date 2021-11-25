import {languages} from "../models/Language";
import {useState} from "react";
import SearchPane from "./SearchPane";

function Home() {
    const [selectedLanguage, setSelectedLanguage] = useState(null);

    return (
        <div className={`container`}>
            <div className={`d-flex btn-group mb-3 mt-3`} role="group">
                {languages.map(language =>
                    <button
                        type='button'
                        className={`flex-basis-0 btn btn btn-outline ${language.code === selectedLanguage ? 'btn-secondary' : ''}`}
                        key={`lang-${language.code}`} onClick={() => setSelectedLanguage(language.code)}>
                        {language.name}
                    </button>
                )}
            </div>
            {selectedLanguage ? <SearchPane selectedLanguage={selectedLanguage}/> :
                <div>Welcome, please select a language to start</div>}
        </div>
    );
}

export default Home;
