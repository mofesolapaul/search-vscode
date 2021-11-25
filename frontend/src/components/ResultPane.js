function ResultPane({ data }) {
    return (
        <div className="resultPane">
            <table className={`table table-striped table-hover table-sm table-bordered`}>
                <thead className={`thead-light`}>
                <tr>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Link to GitHub</th>
                </tr>
                </thead>
                <tbody>
                {data.map((result, index) => (
                    <tr key={index}>
                        <td>{result.name}</td>
                        <td>{result.path}</td>
                        <td><a href={result.html_url} target="_blank" rel="noreferrer">view on github</a></td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
}

export default ResultPane;
