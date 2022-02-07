import React from 'react'
import UpdateProfil from "../components/Profil/UpdateProfil"
import ShowProfil from "../components/Profil/ShowProfil"
import { DeleleteProfil } from '../components/Profil/DeleleteProfil'


export default function Profil() {
    return (
        <div>
            <ShowProfil />
            <UpdateProfil />
            <DeleleteProfil />
        </div>
    )
}