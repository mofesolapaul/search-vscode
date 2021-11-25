import {useCallback, useState} from "react";
import Api from "../services/Api";
import ResultPane from "./ResultPane";

function SearchPane({selectedLanguage}) {
    const [searchQuery, setSearchQuery] = useState('');
    const [searchResult, setSearchResult] = useState([]);
    const [errorMessage, setErrorMessage] = useState('');

    const performSearch = useCallback(async () => {
        console.log('callback');
        if (!searchQuery.trim()) {
            setErrorMessage('Please input something in the search box first.');
            return;
        }

        const response = await Api.search({
            language: selectedLanguage,
            query: searchQuery
        }).catch(e => {
            setErrorMessage(e.error);
        });
        if (response) {
            setErrorMessage('');
            setSearchResult(response);
        }
    }, [searchQuery, selectedLanguage]);

    return (
        <div className="searchPane">
            <div className="searchBox">
                Search vscode:
                <div>
                    <input type="text" value={searchQuery} onChange={e => setSearchQuery(e.target.value)}/>
                    <button onClick={() => performSearch()}>Search</button>
                </div>
                {errorMessage ? <div>{errorMessage}</div> : null}
            </div>
            {!errorMessage && searchResult.length ? <ResultPane data={searchResult}/> : null}
        </div>
    );
}

export default SearchPane;
