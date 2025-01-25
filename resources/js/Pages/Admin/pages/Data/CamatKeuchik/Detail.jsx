import React from "react";

import Sidebar from "@/Components/admin/Sidebar/Sidebar";
import Header from "@/Components/admin/Header/Header";
import { Head, Link, router } from "@inertiajs/react";
import { Breadcrumbs } from "@mui/material";
import { NavigateNext } from "@mui/icons-material";

const List = ({ data, base_url }) => {
    return (
        <section className="main flex">
            <Head title={`${data?.name || "Camat & Keuchik"}`} />

            <div className="sidebarWrapper flex">
                <Sidebar tabId={1} />
            </div>
            <div className="flex w-full ml-72 flex-col">
                <Header></Header>

                <div className="space"></div>

                <div className="px-3 ">
                    <section className="flex flex-col gap-y-3">
                        <Breadcrumbs
                            label="breadcrumbs"
                            separator={<NavigateNext />}
                        >
                            <Link href="/admin/data/camat-keuchik">
                                Camat Keuchik
                            </Link>
                            <Link className="text-primary">Detail</Link>
                        </Breadcrumbs>
                        <div className="p-5 bg-white border ">
                            <table className="table-auto">
                                <tbody>
                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            Nama
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            {data?.name}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            Pangkat & Golongan
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            {data?.pangkat_dan_golongan}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            NIP
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            {data?.nip}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            Jabatan
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            {data?.jabatan}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            Kecamatan
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            {data?.kecamatan}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            Desa
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            {data?.desa}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            Nama Bank
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            {data?.nama_bank}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            No Rekening
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            {data?.no_rekening}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            No NPWP
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            {data?.no_npwp}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="pr-3 text-right align-top font-semibold">
                                            Dokumen
                                        </td>
                                        <td className="mr-4 text-left align-top">
                                            <a
                                                target="_blank"
                                                href={`${base_url}/storage/${data?.link_document.replace(
                                                    "public/",
                                                    ""
                                                )}`}
                                                className="px-2 bg-primary text-white py-1 rounded-md"
                                            >
                                                dokumen
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    );
};

export default List;
