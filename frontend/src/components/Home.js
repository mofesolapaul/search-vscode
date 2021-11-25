import {languages} from "../models/Language";
import {useState} from "react";
import SearchPane from "./SearchPane";

function Home() {
    const [selectedLanguage, setSelectedLanguage] = useState(null);

    return (
        <div className="main">
            <div className="tab">
                {languages.map(language =>
                    <button key={`lang-${language.code}`} onClick={() => setSelectedLanguage(language.code)}>
                        {language.name}
                    </button>
                )}
            </div>
            {selectedLanguage ? <SearchPane selectedLanguage={selectedLanguage}/> :
                <div>Select a language to start</div>}
        </div>
    );
}

export default Home;
