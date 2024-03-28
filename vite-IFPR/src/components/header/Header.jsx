import React from "react";
import '../header/style.css';

export default function Header() {
    return (
        <header className="headerContainer">
            <div className="headerMain">
                <div className="logo"></div>
                <div className="container">
                    <button className="button">inicio</button>
                    <button className="button">evento</button>
                    <button className="button">palestrantes</button>
                    <button className="button">oficinas</button>
                    <button className="button">cronograma</button>
                    <button className="button">inscrição</button>
                </div>
            </div>
        </header>
    );
}
