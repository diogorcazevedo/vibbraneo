'use client'


import { PhotoIcon, UserCircleIcon } from '@heroicons/react/24/solid'
import React, {useEffect, useState} from "react";
import {AUTH_STORAGE, USER_STORAGE} from "@/storage/storageConfig";
import {api} from "@/services/api";
import {AppError} from "@/utils/AppError";
import {useForm} from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup"
import * as yup from "yup"
import {FormDeal} from "@/components/forms/FormDeal";
import {FormDealPhoto} from "@/components/forms/FormDealPhoto";
import {useRouter} from "next/navigation";
import {FormDealUrgency} from "@/components/forms/FormDealUrgency";
import {FormDealLocation} from "@/components/forms/FormDealLocation";
import {getRequestError} from "@/app/services/error";
import {ErrorMessage} from "@/components/ErrorMessage";
import Link from "next/link";
import SlideFormBidAcceptEdit from "@/components/forms/SlideFormBidAcceptEdit";
import SlideFormDealActiveEdit from "@/components/forms/SlideFormDealActiveEdit";

export default function Edit({ params }) {

    const [deal, setDeal] = useState(null);
    const [loading, setLoading] = useState(true);
    const [errorMessage, setErrorMessage] = useState(false);
    const { push } = useRouter();

    useEffect(() => {
        const token = localStorage.getItem(AUTH_STORAGE);
        const getData = async () => {
            try {
                api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                const response = await api.get('/deal/getById/'+params.deal);
                setDeal(response.data.deal)
                setLoading(false);
            } catch (error) {
                setLoading(true);
                const msn = await getRequestError(error);
                setErrorMessage(msn);
                push("/")
            }
        };
        getData();
    }, [loading]);

    const { register, handleSubmit, formState: { errors } } = useForm();

    return (
        <>
            {loading && <p>Loading...</p>}
            <ErrorMessage errorMessage={errorMessage} />
            {!loading &&
                <div className="space-y-10 divide-y divide-gray-900/10">
                    <div className="px-6">
                        <h3 className="text-2xl leading-6 text-green-700">Editar Negócio</h3>
                    </div>
                    <FormDeal deal={deal} />
                    <FormDealPhoto deal={deal} />
                    <FormDealUrgency deal={deal}/>
                    <FormDealLocation deal={deal}/>
                    <SlideFormDealActiveEdit deal={deal} />
                </div>
            }
        </>

    )
}
